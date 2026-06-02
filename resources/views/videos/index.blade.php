<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Videos - Horizon</title>
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

        .videos-page{
            min-height:100vh;
            background:
                linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)),
                #0b0b0b;
        }

        .page-hero{
            position:relative;
            padding:90px 6% 60px;
            background:
                linear-gradient(to right, rgba(0,0,0,0.88) 30%, rgba(0,0,0,0.45) 60%, rgba(0,0,0,0.78) 100%),
                url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=1600&q=80');
            background-size:cover;
            background-position:center;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .page-hero-content{
            max-width:760px;
        }

        .page-tag{
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

        .page-hero h1{
            font-size:54px;
            line-height:1.05;
            font-weight:900;
            margin:0 0 16px;
        }

        .page-hero p{
            color:#d4d4d4;
            font-size:17px;
            line-height:1.8;
            margin:0;
            max-width:650px;
        }

        .page-section{
            max-width:1400px;
            margin:0 auto;
            padding:36px 6% 60px;
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

        .filter-box{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:22px;
            padding:24px;
            margin-bottom:34px;
            box-shadow:0 10px 30px rgba(0,0,0,0.28);
        }

        .filter-grid{
            display:grid;
            grid-template-columns:2fr 1fr 1fr;
            gap:18px;
            align-items:end;
        }

        .filter-group label{
            display:block;
            margin-bottom:8px;
            font-size:14px;
            font-weight:600;
            color:#d8d8d8;
        }

        .filter-control{
            width:100%;
            background:#0e0e0e;
            border:1px solid rgba(255,255,255,0.12);
            color:#fff;
            border-radius:12px;
            padding:13px 14px;
            font-size:14px;
            outline:none;
            transition:.3s ease;
        }

        .filter-control:focus{
            border-color:#e50914;
            box-shadow:0 0 0 3px rgba(229,9,20,0.12);
        }

        .filter-actions{
            display:flex;
            gap:12px;
        }

        .btn-dark,
        .btn-outline{
            width:100%;
            border:none;
            border-radius:12px;
            padding:13px 16px;
            font-size:14px;
            font-weight:700;
            cursor:pointer;
            transition:.3s ease;
        }

        .btn-dark{
            background:#e50914;
            color:#fff;
        }

        .btn-dark:hover{
            background:#b20710;
        }

        .btn-outline{
            background:transparent;
            color:#fff;
            border:1px solid rgba(255,255,255,0.18);
        }

        .btn-outline:hover{
            background:rgba(255,255,255,0.08);
        }

        .results-head{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            margin-bottom:22px;
            flex-wrap:wrap;
        }

        .results-head h2{
            margin:0;
            font-size:30px;
            font-weight:800;
        }

        .results-head p{
            margin:0;
            color:#bbbbbb;
            font-size:14px;
        }

        .videos-grid{
            display:grid;
            grid-template-columns:repeat(4, 1fr);
            gap:22px;
        }

        .video-card{
            background:#121212;
            border-radius:18px;
            overflow:hidden;
            transition:.3s ease;
            box-shadow:0 8px 20px rgba(0,0,0,0.25);
            border:1px solid rgba(255,255,255,0.06);
        }

        .video-card:hover{
            transform:translateY(-6px);
            box-shadow:0 18px 35px rgba(0,0,0,0.38);
        }

        .video-thumb-wrap{
            position:relative;
            height:260px;
            background:#1a1a1a;
            overflow:hidden;
        }

        .video-thumb{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
            transition:transform .35s ease;
        }

        .video-card:hover .video-thumb{
            transform:scale(1.05);
        }

        .video-thumb-empty{
            width:100%;
            height:100%;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#8f8f8f;
            font-size:14px;
            background:linear-gradient(135deg, #1b1b1b, #101010);
        }

        .video-badges{
            position:absolute;
            top:12px;
            right:12px;
            display:flex;
            flex-direction:column;
            gap:8px;
            z-index:2;
        }

        .badge{
            font-size:11px;
            font-weight:700;
            padding:7px 10px;
            border-radius:999px;
            width:max-content;
            margin-left:auto;
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

        .video-content{
            padding:18px;
        }

        .video-title{
            margin:0 0 10px;
            font-size:19px;
            font-weight:800;
            color:#fff;
            line-height:1.4;
            display:-webkit-box;
            -webkit-line-clamp:1;
            -webkit-box-orient:vertical;
            overflow:hidden;
        }

        .video-desc{
            margin:0 0 14px;
            color:#bdbdbd;
            font-size:14px;
            line-height:1.7;
            display:-webkit-box;
            -webkit-line-clamp:2;
            -webkit-box-orient:vertical;
            overflow:hidden;
            min-height:48px;
        }

        .video-tags{
            display:flex;
            flex-wrap:wrap;
            gap:8px;
        }

        .video-tag{
            font-size:12px;
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.08);
            color:#d7d7d7;
            padding:6px 10px;
            border-radius:999px;
        }

        .empty-box{
            background:#141414;
            border:1px solid rgba(255,255,255,0.08);
            border-radius:18px;
            padding:50px 24px;
            text-align:center;
            color:#bdbdbd;
        }

        .pagination-wrap{
            margin-top:36px;
            display:flex;
            justify-content:center;
        }

        .pagination-wrap nav{
            background:#121212;
            padding:12px 16px;
            border-radius:16px;
            border:1px solid rgba(255,255,255,0.08);
            overflow:auto;
        }

        .pagination-wrap svg{
            width:18px;
            height:18px;
        }

        .pagination-wrap .relative.inline-flex.items-center{
            background:transparent !important;
            color:#d7d7d7 !important;
            border-color:rgba(255,255,255,0.08) !important;
        }

        .pagination-wrap span[aria-current="page"] span,
        .pagination-wrap button[aria-current="page"]{
            background:#e50914 !important;
            color:#fff !important;
            border-color:#e50914 !important;
        }

        @media (max-width:1200px){
            .videos-grid{
                grid-template-columns:repeat(3, 1fr);
            }
        }

        @media (max-width:992px){
            .filter-grid{
                grid-template-columns:1fr 1fr;
            }

            .videos-grid{
                grid-template-columns:repeat(2, 1fr);
            }

            .page-hero h1{
                font-size:42px;
            }
        }

        @media (max-width:768px){
            .page-hero{
                padding:70px 5% 50px;
            }

            .page-hero h1{
                font-size:34px;
            }

            .page-hero p{
                font-size:15px;
            }

            .page-section{
                padding:28px 5% 50px;
            }

            .filter-grid{
                grid-template-columns:1fr;
            }

            .filter-actions{
                flex-direction:column;
            }

            .videos-grid{
                grid-template-columns:1fr;
            }

            .video-thumb-wrap{
                height:240px;
            }
        }
    </style>
</head>
<body>
    <div class="videos-page">
        @include('layouts.navigation')

        <section class="page-hero">
            <div class="page-hero-content">
                <span class="page-tag">Horizon Video Library</span>
                <h1>Browse Videos</h1>
                <p>
                    Explore Horizon’s growing collection of videos, discover new content by category,
                    and unlock downloads with an active subscription.
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

            <div class="filter-box">
                <form id="filterForm" class="filter-grid" method="GET" action="{{ route('videos.index') }}">
                    <div class="filter-group">
                        <label for="q">Search</label>
                        <input
                            id="q"
                            class="filter-control"
                            name="q"
                            placeholder="Search by title or description"
                            value="{{ request('q') }}"
                        >
                    </div>

                    <div class="filter-group">
                        <label for="category">Category</label>
                        <select id="category" class="filter-control" name="category">
                            <option value="">All categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" @selected(request('category') === $cat->slug)>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Actions</label>
                        <div class="filter-actions">
                            <button type="submit" class="btn-dark">
                                Filter
                            </button>

                            <button type="button" id="resetFilters" class="btn-outline">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="results-head">
                <div>
                    <h2>Available Videos</h2>
                    <p>{{ $videos->total() }} video{{ $videos->total() != 1 ? 's' : '' }} found</p>
                </div>
            </div>

            @if($videos->count())
                <div class="videos-grid">
                    @foreach($videos as $video)
                        <a href="{{ route('videos.show', $video) }}" class="video-card">
                            <div class="video-thumb-wrap">
                                @if($video->poster_path)
                                    <img
                                        src="{{ $video->poster_path }}"
                                        alt="{{ $video->title }}"
                                        class="video-thumb"
                                    >
                                @else
                                    <div class="video-thumb-empty">
                                        No Poster Available
                                    </div>
                                @endif

                                <div class="video-badges">
                                    @if($video->is_published)
                                        <span class="badge badge-green">Published</span>
                                    @endif

                                    @if($video->is_downloadable)
                                        <span class="badge badge-blue">Downloadable</span>
                                    @endif
                                </div>
                            </div>

                            <div class="video-content">
                                <h3 class="video-title">{{ $video->title }}</h3>

                                <p class="video-desc">
                                    {{ $video->description ?: 'No description available.' }}
                                </p>

                                <div class="video-tags">
                                    @foreach($video->categories as $c)
                                        <span class="video-tag">#{{ $c->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-box">
                    No videos found.
                </div>
            @endif

            <div class="pagination-wrap">
                {{ $videos->links() }}
            </div>
        </main>

        @include('layouts.footer')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const resetBtn = document.getElementById('resetFilters');

            if (resetBtn) {
                resetBtn.addEventListener('click', function () {
                    window.location.href = "{{ route('videos.index') }}";
                });
            }

            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(el => {
                    el.style.transition = 'opacity 0.4s ease';
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 400);
                });
            }, 3000);
        });
    </script>
</body>
</html>