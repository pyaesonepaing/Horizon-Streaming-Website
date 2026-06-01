<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    public function index(Request $request): View
    {
        $plans = Plan::query()
            ->where('is_active', true)
            ->orderBy('price_cents')
            ->get();

        $activeSubscription = $request->user()
            ->activeSubscription()
            ->with(['plan', 'payments' => function ($query) {
                $query->latest('paid_at');
            }])
            ->first();

        $pendingSubscription = $request->user()
            ->pendingSubscription()
            ->with(['plan', 'payments'])
            ->first();

        return view('subscribe.index', compact('plans', 'activeSubscription', 'pendingSubscription'));
    }

    public function checkout(Request $request, Plan $plan): View|RedirectResponse
    {
        $user = $request->user();

        if (! $plan->is_active) {
            return redirect()->route('subscribe.index')->with('error', 'This plan is not available.');
        }

        if ($user->hasActiveSubscription()) {
            return redirect()->route('subscribe.index')
                ->with('error', 'You already have an active subscription. Cancel it before choosing another plan.');
        }

        if ($user->pendingSubscription()->exists()) {
            return redirect()->route('subscribe.index')
                ->with('error', 'You already have a pending subscription request.');
        }

        $paymentMethods = [
            [
                'key' => 'kbz',
                'name' => 'KBZ Bank Transfer',
                'account_name' => 'Horizon Streaming',
                'account_number' => '09123456789',
            ],
            [
                'key' => 'aya',
                'name' => 'AYA Bank Transfer',
                'account_name' => 'Horizon Streaming',
                'account_number' => '09123456780',
            ],
            [
                'key' => 'cb',
                'name' => 'CB Bank Transfer',
                'account_name' => 'Horizon Streaming',
                'account_number' => '09123456781',
            ],
            [
                'key' => 'uab',
                'name' => 'UAB Bank Transfer',
                'account_name' => 'Horizon Streaming',
                'account_number' => '09123456782',
            ],
            [
                'key' => 'wavepay',
                'name' => 'WavePay',
                'account_name' => 'Horizon Streaming',
                'account_number' => '09123456783',
            ],
            [
                'key' => 'kpay',
                'name' => 'KBZPay',
                'account_name' => 'Horizon Streaming',
                'account_number' => '09123456784',
            ],
        ];

        return view('subscribe.checkout', compact('plan', 'paymentMethods'));
    }

    public function storeCheckout(Request $request, Plan $plan): RedirectResponse
    {
        $user = $request->user();

        if (! $plan->is_active) {
            return redirect()->route('subscribe.index')->with('error', 'This plan is not available.');
        }

        if ($user->hasActiveSubscription()) {
            return redirect()->route('subscribe.index')
                ->with('error', 'You already have an active subscription.');
        }

        if ($user->pendingSubscription()->exists()) {
            return redirect()->route('subscribe.index')
                ->with('error', 'You already have a pending subscription request.');
        }

        $validated = $request->validate([
            'payment_method' => ['required', 'string', 'max:50'],
            'payer_name' => ['required', 'string', 'max:255'],
            'payer_phone' => ['nullable', 'string', 'max:50'],
            'transaction_reference' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'receipt' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:4096'],
        ]);

        DB::transaction(function () use ($user, $plan, $validated, $request) {
            $count = max((int) ($plan->interval_count ?? 1), 1);
            $startAt = now();

            $endsAt = match (strtolower($plan->interval)) {
                'day', 'daily' => $startAt->copy()->addDays($count),
                'week', 'weekly' => $startAt->copy()->addWeeks($count),
                'month', 'monthly' => $startAt->copy()->addMonths($count),
                'year', 'yearly', 'annual' => $startAt->copy()->addYears($count),
                default => $startAt->copy()->addMonths($count),
            };

            $subscription = Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'status' => 'pending',
                'starts_at' => $startAt,
                'ends_at' => $endsAt,
                'canceled_at' => null,
            ]);

            $receiptPath = $request->file('receipt')->store('payment-receipts', 'public');

            Payment::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'amount_cents' => $plan->price_cents,
                'currency' => $plan->currency ?: 'USD',
                'provider' => 'manual_bank',
                'provider_reference' => 'MANUAL-' . strtoupper(uniqid()),
                'payment_method' => $validated['payment_method'],
                'payer_name' => $validated['payer_name'],
                'payer_phone' => $validated['payer_phone'] ?? null,
                'transaction_reference' => $validated['transaction_reference'],
                'receipt_path' => $receiptPath,
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending',
                'paid_at' => null,
            ]);
        });

        return redirect()
            ->route('subscribe.index')
            ->with('success', 'Your payment form has been submitted. Please wait for admin approval.');
    }

    public function cancel(Request $request): RedirectResponse
    {
        $user = $request->user();

        $subscription = $user->activeSubscription()->with('payments')->first();

        if (! $subscription) {
            $subscription = $user->pendingSubscription()->with('payments')->first();
        }

        if (! $subscription) {
            return back()->with('error', 'You do not have an active or pending subscription.');
        }

        DB::transaction(function () use ($subscription) {
            $subscription->update([
                'status' => 'canceled',
                'canceled_at' => now(),
                'ends_at' => now(),
            ]);

            foreach ($subscription->payments as $payment) {
                if ($payment->status === 'pending') {
                    $payment->update([
                        'status' => 'failed',
                    ]);
                }
            }
        });

        return redirect()
            ->route('subscribe.index')
            ->with('success', 'Your subscription has been canceled successfully.');
    }
}