@extends('layouts.admin')

@section('page_title', 'Manage Users')
@section('page_description', 'Review user accounts, subscription status, and admin access permissions.')

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

        .table-card{
            background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border:1px solid rgba(255,255,255,0.08);
            border-radius:22px;
            overflow:hidden;
        }

        .table-wrap{
            overflow-x:auto;
        }

        .admin-table{
            width:100%;
            border-collapse:collapse;
        }

        .admin-table thead{
            background:rgba(255,255,255,0.04);
        }

        .admin-table th{
            text-align:left;
            padding:16px;
            color:#a9a9a9;
            font-size:13px;
            font-weight:700;
            border-bottom:1px solid rgba(255,255,255,0.08);
            white-space:nowrap;
        }

        .admin-table td{
            padding:16px;
            border-bottom:1px solid rgba(255,255,255,0.06);
            color:#e5e5e5;
            font-size:14px;
            vertical-align:middle;
        }

        .user-row:hover{
            background:rgba(255,255,255,0.02);
        }

        .user-cell{
            display:flex;
            align-items:center;
            gap:14px;
            min-width:240px;
        }

        .avatar{
            width:44px;
            height:44px;
            border-radius:50%;
            background:linear-gradient(135deg, #e50914, #b20710);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:16px;
            font-weight:900;
            color:#fff;
            flex-shrink:0;
        }

        .user-name{
            color:#fff;
            font-size:15px;
            font-weight:800;
            line-height:1.5;
        }

        .user-sub{
            color:#9ca3af;
            font-size:12px;
            line-height:1.6;
            margin-top:3px;
            word-break:break-word;
        }

        .badge{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:7px 11px;
            border-radius:999px;
            font-size:11px;
            font-weight:700;
            white-space:nowrap;
        }

        .badge-admin{
            background:rgba(59,130,246,0.16);
            border:1px solid rgba(59,130,246,0.35);
            color:#bfd8ff;
        }

        .badge-user{
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.10);
            color:#d1d5db;
        }

        .badge-premium{
            background:rgba(34,197,94,0.16);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .badge-normal{
            background:rgba(245,158,11,0.16);
            border:1px solid rgba(245,158,11,0.35);
            color:#fde68a;
        }

        .actions{
            display:flex;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
        }

        .action-btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:10px 13px;
            border-radius:10px;
            font-size:13px;
            font-weight:700;
            transition:.3s ease;
            cursor:pointer;
        }

        .btn-make-admin{
            background:rgba(59,130,246,0.12);
            border:1px solid rgba(59,130,246,0.25);
            color:#bfd8ff;
        }

        .btn-make-admin:hover{
            background:rgba(59,130,246,0.18);
        }

        .btn-remove-admin{
            background:rgba(239,68,68,0.12);
            border:1px solid rgba(239,68,68,0.25);
            color:#ffb4b4;
        }

        .btn-remove-admin:hover{
            background:rgba(239,68,68,0.18);
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
        .badge-expired{
            background: rgba(239,68,68,0.16);
            border:1px solid rgba(239,68,68,0.35);
            color:#fecaca;
        }

        .btn-deactivate-sub{
    background: rgba(245,158,11,0.12);
    border: 1px solid rgba(245,158,11,0.28);
    color: #fde68a;
}

.btn-deactivate-sub:hover{
    background: rgba(245,158,11,0.18);
}

.badge-expired{
    background: rgba(239,68,68,0.16);
    border: 1px solid rgba(239,68,68,0.35);
    color: #fecaca;
}

        @media (max-width: 960px){
            .stats-row{
                grid-template-columns:1fr;
            }
        }
    </style>

    <div class="page-head">
        <h2>Manage Users</h2>
        <p>Monitor Horizon members, subscription access, and control administrator permissions.</p>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Users</div>
            <div class="stat-value">{{ $users->total() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Admins On This Page</div>
            <div class="stat-value">{{ $users->where('is_admin', true)->count() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Premium Users On This Page</div>
            <div class="stat-value">{{ $users->filter(fn($user) => $user->hasActiveSubscription())->count() }}</div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Subscription</th>
                        <th>Subscription Expiry</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr class="user-row">
                            <td>
                                <div class="user-cell">
                                    <div class="avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-sub">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                @if($user->is_admin)
                                    <span class="badge badge-admin">Admin</span>
                                @else
                                    <span class="badge badge-user">User</span>
                                @endif
                            </td>

                            <td>
                                @if($user->hasActiveSubscription())
                                    <span class="badge badge-premium">Premium</span>
                                @else
                                    <span class="badge badge-normal">Normal</span>
                                @endif
                            </td>

                            <td>
                                @if($user->hasActiveSubscription())
                                    <div style="font-size:12px; color:#9ca3af; margin-top:4px;">
                                        Expires: {{ $user->subscriptions()->where('ends_at', '>=', now())->latest('ends_at')->first()->ends_at->format('M d, Y') }}
                                    </div>
                                @elseif($user->subscriptions()->where('ends_at', '<=', now())->exists())
                                    <div style="font-size:12px; color:#9ca3af; margin-top:4px;">
                                        Ended: {{ $user->subscriptions()->where('ends_at', '<=', now())->latest('ends_at')->first()->ends_at->format('M d, Y') }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="actions">
                                    <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="action-btn {{ $user->is_admin ? 'btn-remove-admin' : 'btn-make-admin' }}"
                                        >
                                            {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                        </button>
                                    </form>

                                    @if($user->hasActiveSubscription())
                                        <form method="POST" action="{{ route('admin.users.deactivate-subscription', $user) }}">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="action-btn btn-deactivate-sub"
                                                onclick="return confirm('Deactivate this user subscription?')"
                                            >
                                                Deactivate Subscription
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <h4>No users found</h4>
                                    <p>There are no Horizon users available to display right now.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $users->links() }}
    </div>
@endsection