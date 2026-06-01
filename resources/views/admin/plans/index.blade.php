@extends('layouts.admin')

@section('page_title', 'Manage Plans')
@section('page_description', 'Create, update, and control Horizon subscription plans and pricing.')

@section('content')
    <style>
        .page-head{
            margin-bottom:20px;
        }

        .page-head h2{
            font-size:30px;
            font-weight:900;
            color:#fff;
            margin:0 0 6px;
        }

        .page-head p{
            color:#9ca3af;
            font-size:14px;
            line-height:1.8;
            margin:0;
        }

        .stats-row{
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:16px;
            margin-bottom:22px;
        }

        .stat-card{
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:18px;
            padding:18px;
        }

        .stat-label{
            color:#9ca3af;
            font-size:12px;
            text-transform:uppercase;
            letter-spacing:.8px;
            margin-bottom:8px;
        }

        .stat-value{
            color:#fff;
            font-size:28px;
            font-weight:900;
        }

        .form-card,
        .plan-card{
            background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border:1px solid rgba(255,255,255,0.08);
            border-radius:22px;
        }

        .form-card{
            padding:22px;
            margin-bottom:22px;
        }

        .form-card h3{
            margin:0 0 8px;
            font-size:22px;
            font-weight:900;
            color:#fff;
        }

        .form-card p{
            margin:0 0 16px;
            color:#a9a9a9;
            font-size:14px;
            line-height:1.7;
        }

        .grid-form{
            display:grid;
            grid-template-columns:repeat(2, 1fr);
            gap:14px;
        }

        .grid-full{
            grid-column:1 / -1;
        }

        .form-group{
            display:flex;
            flex-direction:column;
            gap:8px;
        }

        .form-label{
            font-size:13px;
            font-weight:700;
            color:#d1d5db;
        }

        .form-control{
            width:100%;
            padding:12px 14px;
            border-radius:12px;
            background:#0f0f0f;
            border:1px solid rgba(255,255,255,0.12);
            color:#fff;
            font-size:14px;
            outline:none;
        }

        .form-control:focus{
            border-color:#e50914;
            box-shadow:0 0 0 3px rgba(229,9,20,0.12);
        }

        .btn-primary,
        .btn-secondary,
        .btn-danger{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:11px 14px;
            border-radius:10px;
            font-size:13px;
            font-weight:700;
            transition:.3s ease;
            cursor:pointer;
        }

        .btn-primary{
            background:#e50914;
            color:#fff;
            border:1px solid #e50914;
        }

        .btn-primary:hover{
            background:#b20710;
            border-color:#b20710;
        }

        .btn-secondary{
            background:rgba(59,130,246,0.12);
            border:1px solid rgba(59,130,246,0.25);
            color:#bfd8ff;
        }

        .btn-secondary:hover{
            background:rgba(59,130,246,0.18);
        }

        .btn-danger{
            background:rgba(239,68,68,0.12);
            border:1px solid rgba(239,68,68,0.25);
            color:#ffb4b4;
        }

        .btn-danger:hover{
            background:rgba(239,68,68,0.18);
        }

        .plans-list{
            display:flex;
            flex-direction:column;
            gap:18px;
        }

        .plan-card{
            padding:20px;
        }

        .plan-top{
            display:flex;
            justify-content:space-between;
            gap:16px;
            align-items:flex-start;
            margin-bottom:16px;
            flex-wrap:wrap;
        }

        .plan-top h3{
            margin:0 0 6px;
            color:#fff;
            font-size:24px;
            font-weight:900;
        }

        .plan-top p{
            margin:0;
            color:#a9a9a9;
            font-size:14px;
        }

        .plan-status{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:7px 11px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
            white-space:nowrap;
        }

        .status-active{
            background:rgba(34,197,94,0.16);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .status-inactive{
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.10);
            color:#d1d5db;
        }

        .switch-item{
            display:flex;
            align-items:center;
            gap:10px;
            font-size:14px;
            color:#d1d5db;
            margin-top:8px;
        }

        .switch-item input{
            accent-color:#e50914;
        }

        .action-row{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            margin-top:8px;
        }

        .empty-state{
            padding:48px 24px;
            text-align:center;
            color:#bdbdbd;
        }

        .empty-state h4{
            margin:0 0 8px;
            color:#fff;
            font-size:22px;
            font-weight:900;
        }

        .empty-state p{
            margin:0;
            color:#a9a9a9;
            line-height:1.8;
        }

        .pagination-wrap{
            margin-top:18px;
        }

        @media (max-width: 900px){
            .stats-row{
                grid-template-columns:1fr;
            }

            .grid-form{
                grid-template-columns:1fr;
            }
        }
    </style>

    <div class="page-head">
        <h2>Manage Plans</h2>
        <p>Set up Horizon subscription plans, pricing, billing intervals, and active availability.</p>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Plans</div>
            <div class="stat-value">{{ $plans->total() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Active On This Page</div>
            <div class="stat-value">{{ $plans->where('is_active', true)->count() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Plans On This Page</div>
            <div class="stat-value">{{ $plans->count() }}</div>
        </div>
    </div>

    <div class="form-card">
        <h3>Add New Plan</h3>
        <p>Create a new subscription plan with pricing, interval, and visibility settings.</p>

        <form method="POST" action="{{ route('admin.plans.store') }}" class="grid-form">
            @csrf

            <div class="form-group">
                <label class="form-label">Plan Name</label>
                <input type="text" name="name" placeholder="Plan name" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Price (in cents)</label>
                <input type="number" name="price_cents" placeholder="Price in cents" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Currency</label>
                <input type="text" name="currency" value="USD" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Interval</label>
                <input type="text" name="interval" value="month" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Interval Count</label>
                <input type="number" name="interval_count" value="1" class="form-control" required>
            </div>

            <div class="form-group grid-full">
                <label class="form-label">Description</label>
                <input type="text" name="description" placeholder="Description" class="form-control">
            </div>

            <div class="grid-full">
                <button type="submit" class="btn-primary">Add Plan</button>
            </div>
        </form>
    </div>

    <div class="plans-list">
        @forelse($plans as $plan)
            <div class="plan-card">
                <div class="plan-top">
                    <div>
                        <h3>{{ $plan->name }}</h3>
                        <p>
                            {{ $plan->currency }} {{ number_format($plan->price_cents / 100, 2) }}
                            • every {{ $plan->interval_count }} {{ \Illuminate\Support\Str::plural($plan->interval, $plan->interval_count) }}
                        </p>
                    </div>

                    <span class="plan-status {{ $plan->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $plan->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <form method="POST" action="{{ route('admin.plans.update', $plan) }}" class="grid-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Plan Name</label>
                        <input type="text" name="name" value="{{ $plan->name }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Price (in cents)</label>
                        <input type="number" name="price_cents" value="{{ $plan->price_cents }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Currency</label>
                        <input type="text" name="currency" value="{{ $plan->currency }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Interval</label>
                        <input type="text" name="interval" value="{{ $plan->interval }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Interval Count</label>
                        <input type="number" name="interval_count" value="{{ $plan->interval_count }}" class="form-control" required>
                    </div>

                    <div class="form-group grid-full">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" value="{{ $plan->description }}" class="form-control">
                    </div>

                    <div class="grid-full">
                        <label class="switch-item">
                            <input type="checkbox" name="is_active" value="1" {{ $plan->is_active ? 'checked' : '' }}>
                            Active
                        </label>
                    </div>

                    <div class="grid-full action-row">
                        <button type="submit" class="btn-secondary">Update Plan</button>
                </form>

                        <form method="POST" action="{{ route('admin.plans.destroy', $plan) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('Delete this plan?')">
                                Delete
                            </button>
                        </form>
                    </div>
            </div>
        @empty
            <div class="form-card">
                <div class="empty-state">
                    <h4>No plans found</h4>
                    <p>Your Horizon platform does not have any subscription plans yet.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="pagination-wrap">
        {{ $plans->links() }}
    </div>
@endsection