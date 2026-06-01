<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download History - Horizon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('storage/img/logo.png') }}">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing:border-box;
        }

        body{
            font-family: Arial, Helvetica, sans-serif;
            background:#0b0b0b;
            color:#fff;
            overflow-x:hidden;
        }

        a{
            text-decoration:none;
        }

        .history-page{
            min-height:100vh;
            background:
                linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)),
                #0b0b0b;
        }

        .history-hero{
            position:relative;
            padding:90px 6% 55px;
            background:
                linear-gradient(to right, rgba(0,0,0,0.9) 25%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.82) 100%),
                url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=1600&q=80');
            background-size:cover;
            background-position:center;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .history-hero-content{
            max-width:760px;
        }

        .history-tag{
            display:inline-block;
            background:rgba(229,9,20,0.18);
            border:1px solid rgba(229,9,20,0.45);
            color:#ffb3b8;
            padding:8px 14px;
            border-radius:999px;
            font-size:13px;
            margin-bottom:18px;
            letter-spacing:.4px;
        }

        .history-hero h1{
            margin:0 0 14px;
            font-size:52px;
            font-weight:900;
            line-height:1.08;
        }

        .history-hero p{
            margin:0;
            color:#d6d6d6;
            max-width:680px;
            font-size:16px;
            line-height:1.8;
        }

        .page-section{
            max-width:1400px;
            margin:0 auto;
            padding:36px 6% 60px;
        }

        .stats-row{
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:18px;
            margin-bottom:24px;
        }

        .stat-card{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:20px;
            padding:22px;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
        }

        .stat-label{
            color:#a8a8a8;
            font-size:13px;
            margin-bottom:8px;
        }

        .stat-value{
            font-size:30px;
            font-weight:900;
            color:#fff;
        }

        .history-card{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            overflow:hidden;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
        }

        .table-wrap{
            overflow-x:auto;
        }

        .history-table{
            width:100%;
            border-collapse:collapse;
        }

        .history-table th{
            text-align:left;
            padding:16px 18px;
            color:#b8b8b8;
            font-size:13px;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .history-table td{
            padding:16px 18px;
            border-bottom:1px solid rgba(255,255,255,0.06);
            vertical-align:middle;
            font-size:14px;
            color:#e5e5e5;
        }

        .video-cell{
            display:flex;
            align-items:center;
            gap:14px;
            min-width:260px;
        }

        .video-thumb{
            width:70px;
            height:50px;
            object-fit:cover;
            border-radius:10px;
            background:#1a1a1a;
            flex-shrink:0;
        }

        .video-title{
            font-weight:700;
            color:#fff;
            line-height:1.5;
        }

        .video-sub{
            color:#9ca3af;
            font-size:12px;
            margin-top:4px;
        }

        .badge{
            display:inline-block;
            padding:7px 11px;
            border-radius:999px;
            font-size:11px;
            font-weight:700;
        }

        .badge-plan{
            background:rgba(59,130,246,0.16);
            border:1px solid rgba(59,130,246,0.35);
            color:#bfd8ff;
        }

        .btn-link{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:10px 14px;
            border-radius:10px;
            font-size:13px;
            font-weight:700;
            color:#fff;
            border:1px solid rgba(255,255,255,0.16);
            background:transparent;
            transition:.3s ease;
        }

        .btn-link:hover{
            background:rgba(255,255,255,0.08);
        }

        .empty-box{
            background:#141414;
            border:1px solid rgba(255,255,255,0.08);
            border-radius:20px;
            padding:50px 24px;
            text-align:center;
            color:#bdbdbd;
        }

        .pagination-wrap{
            margin-top:24px;
        }

        @media (max-width: 992px){
            .stats-row{
                grid-template-columns:1fr;
            }

            .history-hero h1{
                font-size:40px;
            }
        }

        @media (max-width: 768px){
            .history-hero{
                padding:72px 5% 45px;
            }

            .history-hero h1{
                font-size:32px;
            }

            .history-hero p{
                font-size:15px;
            }

            .page-section{
                padding:28px 5% 50px;
            }
        }
    </style>
</head>
<body>
    <div class="history-page">
        @include('layouts.navigation')

        <section class="history-hero">
            <div class="history-hero-content">
                <span class="history-tag">Your Premium Activity</span>
                <h1>Download History</h1>
                <p>
                    Review the videos you downloaded with your Horizon subscription,
                    including dates and the plan used at the time of download.
                </p>
            </div>
        </section>

        <main class="page-section">
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-label">Total Downloads</div>
                    <div class="stat-value">{{ $downloads->total() }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">This Page</div>
                    <div class="stat-value">{{ $downloads->count() }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Latest Download</div>
                    <div class="stat-value" style="font-size:18px;">
                        {{ $downloads->first()?->downloaded_at?->format('d M Y') ?? 'No downloads yet' }}
                    </div>
                </div>
            </div>

            @if($downloads->count())
                <div class="history-card">
                    <div class="table-wrap">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>Video</th>
                                    <th>Downloaded At</th>
                                    <th>Subscription</th>
                                    <th>IP Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($downloads as $download)
                                    <tr>
                                        <td>
                                            <div class="video-cell">
                                                @if($download->video?->poster_path)
                                                    <img
                                                        src="{{ asset('storage/' . $download->video->poster_path) }}"
                                                        alt="{{ $download->video->title }}"
                                                        class="video-thumb"
                                                    >
                                                @else
                                                    <div class="video-thumb"></div>
                                                @endif

                                                <div>
                                                    <div class="video-title">
                                                        {{ $download->video->title ?? 'Video unavailable' }}
                                                    </div>
                                                    <div class="video-sub">
                                                        {{ $download->video?->categories?->pluck('name')->implode(', ') ?: 'Horizon Video' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            {{ $download->downloaded_at?->format('d M Y H:i') ?? '-' }}
                                        </td>

                                        <td>
                                            @if($download->subscription?->plan)
                                                <span class="badge badge-plan">
                                                    {{ $download->subscription->plan->name }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            {{ $download->ip_address ?: '-' }}
                                        </td>

                                        <td>
                                            @if($download->video)
                                                <a href="{{ route('videos.show', $download->video) }}" class="btn-link">
                                                    View Video
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="pagination-wrap">
                    {{ $downloads->links() }}
                </div>
            @else
                <div class="empty-box">
                    You have no download history yet.
                </div>
            @endif
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>