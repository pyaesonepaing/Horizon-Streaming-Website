<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }} - Horizon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('storage/img/logo.png') }}">
    <style>
        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            font-family: Arial, Helvetica, sans-serif;
            background:#0b0b0b;
            color:#fff;
        }

        a{
            text-decoration:none;
        }

        .video-show-page{
            min-height:100vh;
            background:
                linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)),
                #0b0b0b;
        }

        .video-hero{
            position:relative;
            padding:90px 6% 55px;
            background:
                linear-gradient(to right, rgba(0,0,0,0.9) 25%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.82) 100%),
                url('{{ $video->poster_path ? asset('storage/' . $video->poster_path) : 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=1600&q=80' }}');
            background-size:cover;
            background-position:center;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .video-hero-content{
            max-width:760px;
        }

        .video-tag{
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

        .video-hero h1{
            margin:0 0 14px;
            font-size:52px;
            font-weight:900;
            line-height:1.08;
        }

        .video-hero p{
            margin:0;
            color:#d6d6d6;
            max-width:680px;
            font-size:16px;
            line-height:1.8;
        }

        .page-section{
            max-width:1400px;
            margin:0 auto;
            padding:34px 6% 60px;
        }

        .alert{
            margin-bottom:20px;
            border-radius:14px;
            padding:16px 18px;
            font-size:14px;
            border:1px solid transparent;
        }

        .alert-success{
            background:rgba(34,197,94,0.12);
            border-color:rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .alert-error{
            background:rgba(239,68,68,0.12);
            border-color:rgba(239,68,68,0.35);
            color:#ffb4b4;
        }

        .show-grid{
            display:grid;
            grid-template-columns:2fr 1fr;
            gap:28px;
            align-items:start;
        }

        .main-card,
        .side-card{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            overflow:hidden;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
        }

        .player-wrap{
            position:relative;
            width:100%;
            aspect-ratio:16 / 9;
            background:#000;
        }

        .player-wrap video{
            width:100%;
            height:100%;
            display:block;
            background:#000;
            object-fit:contain;
        }

        .main-content{
            padding:28px;
        }

        .video-heading{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:18px;
            margin-bottom:18px;
            flex-wrap:wrap;
        }

        .video-heading h2{
            margin:0;
            font-size:34px;
            line-height:1.2;
            font-weight:900;
        }

        .badge-list{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
            margin-top:16px;
        }

        .badge{
            font-size:12px;
            font-weight:700;
            padding:8px 12px;
            border-radius:999px;
            width:max-content;
        }

        .badge-category{
            background:rgba(255,255,255,0.07);
            border:1px solid rgba(255,255,255,0.1);
            color:#dfdfdf;
        }

        .badge-green{
            background:rgba(34,197,94,0.16);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .badge-blue{
            background:rgba(59,130,246,0.16);
            border:1px solid rgba(59,130,246,0.35);
            color:#bfd8ff;
        }

        .description-box{
            margin-top:24px;
            padding-top:22px;
            border-top:1px solid rgba(255,255,255,0.08);
        }

        .description-box h3{
            margin:0 0 10px;
            font-size:20px;
            font-weight:800;
        }

        .description-box p{
            margin:0;
            color:#cfcfcf;
            line-height:1.9;
            font-size:15px;
        }

        .action-box{
            margin-top:28px;
            padding-top:22px;
            border-top:1px solid rgba(255,255,255,0.08);
        }

        .notice-box{
            border-radius:18px;
            padding:18px;
            border:1px solid transparent;
        }

        .notice-yellow{
            background:rgba(245,158,11,0.10);
            border-color:rgba(245,158,11,0.28);
            color:#ffd88f;
        }

        .notice-blue{
            background:rgba(59,130,246,0.10);
            border-color:rgba(59,130,246,0.28);
            color:#bfd8ff;
        }

        .notice-box p{
            margin:0 0 14px;
            line-height:1.7;
            font-size:14px;
        }

        .action-buttons{
            display:flex;
            flex-wrap:wrap;
            gap:12px;
        }

        .btn-primary,
        .btn-secondary{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:13px 18px;
            border-radius:12px;
            font-size:14px;
            font-weight:700;
            transition:.3s ease;
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
            background:transparent;
            color:#fff;
            border:1px solid rgba(255,255,255,0.16);
        }

        .btn-secondary:hover{
            background:rgba(255,255,255,0.08);
        }

        .side-card-content{
            padding:24px;
        }

        .side-card h3{
            margin:0 0 18px;
            font-size:24px;
            font-weight:800;
        }

        .side-poster{
            width:100%;
            height:260px;
            object-fit:cover;
            border-radius:18px;
            display:block;
            margin-bottom:18px;
            background:#1a1a1a;
        }

        .details-list{
            display:flex;
            flex-direction:column;
            gap:14px;
        }

        .detail-item{
            display:flex;
            justify-content:space-between;
            gap:14px;
            padding-bottom:14px;
            border-bottom:1px solid rgba(255,255,255,0.06);
        }

        .detail-label{
            color:#fff;
            font-weight:700;
            font-size:14px;
        }

        .detail-value{
            color:#c8c8c8;
            font-size:14px;
            text-align:right;
        }

        .side-actions{
            margin-top:20px;
        }

        .side-actions a{
            width:100%;
        }

        @media (max-width:992px){
            .show-grid{
                grid-template-columns:1fr;
            }

            .video-hero h1{
                font-size:40px;
            }
        }

        @media (max-width:768px){
            .video-hero{
                padding:72px 5% 45px;
            }

            .video-hero h1{
                font-size:32px;
            }

            .video-hero p{
                font-size:15px;
            }

            .page-section{
                padding:28px 5% 50px;
            }

            .main-content,
            .side-card-content{
                padding:20px;
            }

            .video-heading h2{
                font-size:28px;
            }

            .side-poster{
                height:220px;
            }

            .action-buttons{
                flex-direction:column;
            }

            .btn-primary,
            .btn-secondary{
                width:100%;
            }
        }
    </style>
</head>
<body>
    <div class="video-show-page">
        @include('layouts.navigation')

        <section class="video-hero">
            <div class="video-hero-content">
                <span class="video-tag">Now Playing on Horizon</span>
                <h1>{{ $video->title }}</h1>
                <p>
                    {{ $video->description ?: 'Watch this video on Horizon and enjoy a premium streaming experience with protected downloads and clean viewing across devices.' }}
                </p>
            </div>
        </section>

        <main class="page-section">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="show-grid">
                <div class="main-card">
                    <div class="player-wrap">
                        @php
    $isSubscribed = auth()->check() && auth()->user()->hasActiveSubscription();

    // ONLY subscribed users get full video
    // Everyone else gets ONLY trailer
    $videoPath = $isSubscribed ? $video->stream_path : $video->trailer_path;
@endphp

@if($isSubscribed && $video->stream_path)
    {{-- ✅ Subscribed user → FULL video --}}
    <video id="mainVideo"
        controls
        poster="{{ $video->poster_path ? asset('storage/' . $video->poster_path) : '' }}">
        <source src="{{ asset('storage/' . $video->stream_path) }}" type="video/mp4">
    </video>

@elseif($video->trailer_path)
    {{-- ✅ Guest / non-subscribed → TRAILER only --}}
    <video id="mainVideo"
        controls
        poster="{{ $video->poster_path ? asset('storage/' . $video->poster_path) : '' }}">
        <source src="{{ asset('storage/' . $video->trailer_path) }}" type="video/mp4">
    </video>

@else
    <div class="notice-box notice-yellow">
        <p>Trailer is not available.</p>
    </div>
@endif

                    </div>

                    <div class="main-content">
                        <div class="video-heading">
                            <div>
                                <h2>{{ $video->title }}</h2>

                                <div class="badge-list">
                                    @foreach($video->categories as $category)
                                        <span class="badge badge-category">#{{ $category->name }}</span>
                                    @endforeach

                                    @if($video->is_published)
                                        <span class="badge badge-green">Published</span>
                                    @endif

                                    @if($video->is_downloadable)
                                        <span class="badge badge-blue">Downloadable</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($video->description)
                            <div class="description-box">
                                <h3>Description</h3>
                                <p>{{ $video->description }}</p>
                            </div>
                        @endif

                        {{-- ❗ NOTHING ELSE CHANGED --}}
                        <div class="action-box">
                            @auth
                                @if(auth()->user()->hasActiveSubscription() && $video->is_downloadable && $video->download_path)
                                    <div class="action-buttons">
                                        <a class="btn-primary" href="{{ route('videos.download', $video) }}">
                                            Download Premium Video
                                        </a>

                                        <a class="btn-secondary" href="{{ route('subscribe.index') }}">
                                            Manage Subscription
                                        </a>
                                    </div>
                                @else
                                    <div class="notice-box notice-yellow">
                                        <p>
                                            You are watching the trailer. Subscribe to watch the full video, unlock premium downloads and get more value from Horizon.
                                        </p>
                                        <div class="action-buttons">
                                            <a class="btn-primary" href="{{ route('subscribe.index') }}">
                                                Subscribe Now
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="notice-box notice-blue">
                                    <p>
                                        You are watching the trailer. Subscribe to watch the full video, unlock download access and manage your Horizon account.
                                    </p>
                                    <div class="action-buttons">
                                        <a class="btn-primary" href="{{ route('login') }}">
                                            Login
                                        </a>
                                        <a class="btn-secondary" href="{{ route('register') }}">
                                            Register
                                        </a>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>

                <aside class="side-card">
                    <div class="side-card-content">
                        <h3>Video Details</h3>

                        @if($video->poster_path)
                            <img
                                src="{{ asset('storage/' . $video->poster_path) }}"
                                alt="{{ $video->title }}"
                                class="side-poster"
                            >
                        @endif

                        <div class="details-list">
                            <div class="detail-item">
                                <span class="detail-label">Title</span>
                                <span class="detail-value">{{ $video->title }}</span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">Status</span>
                                <span class="detail-value">{{ $video->is_published ? 'Published' : 'Draft' }}</span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">Download</span>
                                <span class="detail-value">{{ $video->is_downloadable ? 'Allowed' : 'Not allowed' }}</span>
                            </div>

                            @if($video->duration_seconds)
                                <div class="detail-item">
                                    <span class="detail-label">Duration</span>
                                    <span class="detail-value">{{ gmdate('H:i:s', $video->duration_seconds) }}</span>
                                </div>
                            @endif

                            <div class="detail-item">
                                <span class="detail-label">Categories</span>
                                <span class="detail-value">
                                    {{ $video->categories->pluck('name')->implode(', ') ?: 'Uncategorized' }}
                                </span>
                            </div>
                        </div>

                        <div class="side-actions">
                            <a href="{{ route('videos.index') }}" class="btn-secondary">
                                Back to Browse
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </main>

        @include('layouts.footer')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(el => {
                    el.style.transition = 'opacity 0.4s ease';
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 400);
                });
            }, 3000);

            const video = document.getElementById('mainVideo');
            if (video) {
                video.addEventListener('play', () => {
                    console.log('Video started:', @json($video->title));
                });
            }
        });
    </script>
</body>
</html>