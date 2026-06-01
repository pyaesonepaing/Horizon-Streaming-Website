@extends('layouts.admin')

@section('page_title', 'Admin Activity Logs')
@section('page_description', 'Track important admin actions across Horizon and review recent platform changes.')

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

        .log-row:hover{
            background:rgba(255,255,255,0.02);
        }

        .admin-cell{
            display:flex;
            align-items:center;
            gap:12px;
            min-width:200px;
        }

        .avatar{
            width:42px;
            height:42px;
            border-radius:50%;
            background:linear-gradient(135deg, #e50914, #b20710);
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-weight:900;
            font-size:15px;
            flex-shrink:0;
        }

        .admin-name{
            color:#fff;
            font-size:15px;
            font-weight:800;
            line-height:1.5;
        }

        .admin-sub{
            color:#9ca3af;
            font-size:12px;
            line-height:1.6;
            margin-top:3px;
        }

        .entity-badge,
        .action-badge{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:7px 11px;
            border-radius:999px;
            font-size:11px;
            font-weight:700;
            white-space:nowrap;
        }

        .entity-badge{
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.10);
            color:#d1d5db;
        }

        .action-create{
            background:rgba(34,197,94,0.16);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .action-update,
        .action-edit{
            background:rgba(59,130,246,0.16);
            border:1px solid rgba(59,130,246,0.35);
            color:#bfd8ff;
        }

        .action-delete{
            background:rgba(239,68,68,0.16);
            border:1px solid rgba(239,68,68,0.35);
            color:#ffb4b4;
        }

        .action-default{
            background:rgba(245,158,11,0.16);
            border:1px solid rgba(245,158,11,0.35);
            color:#fde68a;
        }

        .date-text{
            color:#d1d5db;
            font-size:14px;
            line-height:1.7;
            white-space:nowrap;
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

        @media (max-width: 960px){
            .stats-row{
                grid-template-columns:1fr;
            }
        }
    </style>

    <div class="page-head">
        <h2>Admin Activity Logs</h2>
        <p>Review recorded admin actions to monitor changes and maintain platform transparency.</p>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Logs</div>
            <div class="stat-value">{{ $logs->total() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Logs On This Page</div>
            <div class="stat-value">{{ $logs->count() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Latest Log</div>
            <div class="stat-value" style="font-size:18px;">
                {{ $logs->first()?->created_at?->format('d M Y') ?? 'No logs yet' }}
            </div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Admin</th>
                        <th>Entity</th>
                        <th>Action</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($logs as $log)
                        @php
                            $action = strtolower($log->action ?? '');
                            $actionClass = match (true) {
                                str_contains($action, 'create') => 'action-create',
                                str_contains($action, 'update') => 'action-update',
                                str_contains($action, 'edit') => 'action-edit',
                                str_contains($action, 'delete') => 'action-delete',
                                default => 'action-default',
                            };
                        @endphp

                        <tr class="log-row">
                            <td>
                                <div class="admin-cell">
                                    <div class="avatar">
                                        {{ strtoupper(substr($log->admin?->name ?? 'A', 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="admin-name">{{ $log->admin?->name ?? 'Unknown Admin' }}</div>
                                        <div class="admin-sub">
                                            {{ $log->admin?->email ?? 'No email available' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="entity-badge">
                                    {{ $log->entity_type }} #{{ $log->entity_id }}
                                </span>
                            </td>

                            <td>
                                <span class="action-badge {{ $actionClass }}">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>

                            <td>
                                <div class="date-text">
                                    {{ $log->created_at?->format('d M Y H:i') }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <h4>No activity logs found</h4>
                                    <p>There are no recorded admin actions to display right now.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $logs->links() }}
    </div>
@endsection