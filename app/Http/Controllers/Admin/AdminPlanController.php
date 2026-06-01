<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->paginate(15);
        return view('admin.plans.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price_cents' => ['required', 'integer', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'interval' => ['required', 'string', 'max:20'],
            'interval_count' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
        ]);

        $plan = Plan::create([
            ...$data,
            'code' => Str::slug($data['name']) . '-' . Str::random(4),
            'is_active' => true,
        ]);

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Plan',
            'entity_id' => $plan->id,
            'action' => 'create',
            'before' => null,
            'after' => $plan->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Plan created.');
    }

    public function update(Request $request, Plan $plan)
    {
        $before = $plan->toArray();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price_cents' => ['required', 'integer', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'interval' => ['required', 'string', 'max:20'],
            'interval_count' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $plan->update([
            ...$data,
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Plan',
            'entity_id' => $plan->id,
            'action' => 'update',
            'before' => $before,
            'after' => $plan->fresh()->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Plan updated.');
    }

    public function destroy(Request $request, Plan $plan)
    {
        $before = $plan->toArray();
        $id = $plan->id;

        $plan->delete();

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Plan',
            'entity_id' => $id,
            'action' => 'delete',
            'before' => $before,
            'after' => null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Plan deleted.');
    }
}