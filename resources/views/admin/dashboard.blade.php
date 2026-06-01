@extends('layouts.admin')
@section('content')
    <style>
        .dashboard-grid{
            display:grid;
            grid-template-columns:repeat(4, 1fr);
            gap:18px;
            margin-bottom:24px;
        }

        .stat-card{
            background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border:1px solid rgba(255,255,255,0.08);
            border-radius:20px;
            padding:22px;
            position:relative;
            overflow:hidden;
        }

        .stat-card::before{
            content:"";
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:4px;
            background:linear-gradient(90deg, #e50914, rgba(229,9,20,0.2));
        }

        .stat-card.users::before{
            background:linear-gradient(90deg, #3b82f6, rgba(59,130,246,0.2));
        }

        .stat-card.videos::before{
            background:linear-gradient(90deg, #a855f7, rgba(168,85,247,0.2));
        }

        .stat-card.subscriptions::before{
            background:linear-gradient(90deg, #22c55e, rgba(34,197,94,0.2));
        }

        .stat-card.downloads::before{
            background:linear-gradient(90deg, #f59e0b, rgba(245,158,11,0.2));
        }

        .stat-label{
            color:#a9a9a9;
            font-size:13px;
            margin-bottom:12px;
            text-transform:uppercase;
            letter-spacing:.8px;
        }

        .stat-value{
            font-size:36px;
            font-weight:900;
            color:#fff;
            line-height:1;
            margin-bottom:10px;
        }

        .stat-sub{
            color:#bdbdbd;
            font-size:13px;
            line-height:1.7;
        }

        .dashboard-lower{
            display:grid;
            grid-template-columns:1.4fr .9fr;
            gap:20px;
        }

        .panel{
            background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border:1px solid rgba(255,255,255,0.08);
            border-radius:22px;
            padding:22px;
        }

        .panel h3{
            margin:0 0 10px;
            font-size:24px;
            font-weight:900;
            color:#fff;
        }

        .panel p{
            margin:0 0 18px;
            color:#bdbdbd;
            line-height:1.8;
            font-size:14px;
        }

        .quick-grid{
            display:grid;
            grid-template-columns:repeat(2, 1fr);
            gap:14px;
        }

        .quick-link{
            display:block;
            padding:16px 18px;
            border-radius:16px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.08);
            color:#fff;
            transition:.3s ease;
        }

        .quick-link:hover{
            transform:translateY(-3px);
            background:rgba(255,255,255,0.06);
            border-color:rgba(229,9,20,0.22);
        }

        .quick-link strong{
            display:block;
            margin-bottom:6px;
            font-size:15px;
        }

        .quick-link span{
            color:#aaaaaa;
            font-size:13px;
            line-height:1.6;
        }

        .summary-list{
            display:flex;
            flex-direction:column;
            gap:14px;
        }

        .summary-item{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            padding:14px 16px;
            border-radius:16px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.08);
        }

        .summary-item-label{
            color:#d7d7d7;
            font-size:14px;
            font-weight:700;
        }

        .summary-item-value{
            color:#fff;
            font-size:18px;
            font-weight:900;
        }

        .welcome-banner{
            margin-bottom:22px;
            padding:22px;
            border-radius:22px;
            background:linear-gradient(135deg, rgba(229,9,20,0.18), rgba(255,255,255,0.03));
            border:1px solid rgba(229,9,20,0.20);
        }

        .welcome-banner h3{
            margin:0 0 8px;
            font-size:26px;
            font-weight:900;
            color:#fff;
        }

        .welcome-banner p{
            margin:0;
            color:#d2d2d2;
            line-height:1.8;
            font-size:14px;
        }

        @media (max-width: 1100px){
            .dashboard-grid{
                grid-template-columns:repeat(2, 1fr);
            }

            .dashboard-lower{
                grid-template-columns:1fr;
            }
        }

        @media (max-width: 640px){
            .dashboard-grid{
                grid-template-columns:1fr;
            }

            .quick-grid{
                grid-template-columns:1fr;
            }

            .stat-value{
                font-size:30px;
            }
        }
    </style>

    <div class="dashboard-grid">
        <div class="stat-card users">
            <div class="stat-label">Users</div>
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-sub">Registered accounts on the Horizon platform.</div>
        </div>

        <div class="stat-card videos">
            <div class="stat-label">Videos</div>
            <div class="stat-value">{{ $totalVideos }}</div>
            <div class="stat-sub">Published and managed video content available in the system.</div>
        </div>

        <div class="stat-card subscriptions">
            <div class="stat-label">Active Subscriptions</div>
            <div class="stat-value">{{ $activeSubscriptions }}</div>
            <div class="stat-sub">Users currently subscribed to active premium plans.</div>
        </div>

        <div class="stat-card downloads">
            <div class="stat-label">Downloads</div>
            <div class="stat-value">{{ $totalDownloads }}</div>
            <div class="stat-sub">Total tracked premium video download activity.</div>
        </div>
    </div>

    <div class="dashboard-lower">
        <div class="panel">
            <h3>Quick Actions</h3>

            <div class="quick-grid">
                <a href="{{ route('admin.videos.index') }}" class="quick-link">
                    <strong>Manage Videos</strong>
                    <span>View, create, edit, and organize Horizon videos.</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="quick-link">
                    <strong>Manage Categories</strong>
                    <span>Organize your video library by category and structure.</span>
                </a>

                <a href="{{ route('admin.plans.index') }}" class="quick-link">
                    <strong>Manage Plans</strong>
                    <span>Update pricing, intervals, and subscription plan settings.</span>
                </a>

                <a href="{{ route('admin.subscription-requests.index') }}" class="quick-link">
                    <strong>Review Requests</strong>
                    <span>Approve or reject user payment and subscription submissions.</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="quick-link">
                    <strong>Manage Users</strong>
                    <span>Check user accounts and update admin permissions.</span>
                </a>

                <a href="{{ route('admin.logs.index') }}" class="quick-link">
                    <strong>Audit Logs</strong>
                    <span>Inspect activity and monitor important system events.</span>
                </a>
            </div>
        </div>

        <div class="panel">
            <h3>Platform Summary</h3>
            <p>
                A snapshot of the most important Horizon admin metrics for fast review.
            </p>

            <div class="summary-list">
                <div class="summary-item">
                    <span class="summary-item-label">Total Users</span>
                    <span class="summary-item-value">{{ $totalUsers }}</span>
                </div>

                <div class="summary-item">
                    <span class="summary-item-label">Total Videos</span>
                    <span class="summary-item-value">{{ $totalVideos }}</span>
                </div>

                <div class="summary-item">
                    <span class="summary-item-label">Active Subscriptions</span>
                    <span class="summary-item-value">{{ $activeSubscriptions }}</span>
                </div>

                <div class="summary-item">
                    <span class="summary-item-label">Total Downloads</span>
                    <span class="summary-item-value">{{ $totalDownloads }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection