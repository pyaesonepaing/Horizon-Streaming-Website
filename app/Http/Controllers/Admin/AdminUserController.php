<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(Request $request, User $user)
    {
        $before = $user->toArray();

        $user->is_admin = !$user->is_admin;
        $user->save();

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'User',
            'entity_id' => $user->id,
            'action' => 'toggle_admin',
            'before' => $before,
            'after' => $user->fresh()->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'User role updated.');
    }

    public function deactivateSubscription(\App\Models\User $user)
{
    $subscription = $user->subscriptions()
        ->where('status', 'active')
        ->where('ends_at', '>', now())
        ->latest()
        ->first();

    if (! $subscription) {
        return back()->with('error', 'This user does not have an active subscription.');
    }

    $subscription->update([
        'status' => 'canceled',
        'canceled_at' => now(),
        'ends_at' => now(),
    ]);

    return back()->with('success', 'User subscription deactivated successfully.');
}
}