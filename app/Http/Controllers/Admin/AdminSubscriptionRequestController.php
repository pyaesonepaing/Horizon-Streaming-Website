<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminSubscriptionRequestController extends Controller
{
    public function index(Request $request): View
{
    $status = $request->get('status'); // pending | paid | failed

    $query = Payment::with(['user', 'subscription.plan'])->latest();

    if ($status) {
        $query->where('status', $status);
    }

    $payments = $query->paginate(10);

    return view('admin.subscription-requests.index', compact('payments', 'status'));
}

    public function approve(Payment $payment): RedirectResponse
    {
        if (! $payment->subscription) {
            return back()->with('error', 'Subscription not found for this payment.');
        }

        DB::transaction(function () use ($payment) {
            $payment->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            $payment->subscription->update([
                'status' => 'active',
            ]);
        });

        return back()->with('success', 'Subscription request approved successfully.');
    }

    public function reject(Payment $payment): RedirectResponse
    {
        if (! $payment->subscription) {
            return back()->with('error', 'Subscription not found for this payment.');
        }

        DB::transaction(function () use ($payment) {
            $payment->update([
                'status' => 'failed',
            ]);

            $payment->subscription->update([
                'status' => 'canceled',
                'canceled_at' => now(),
                'ends_at' => now(),
            ]);
        });

        return back()->with('success', 'Subscription request rejected successfully.');
    }
}