<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ secure_asset('img/logo.png') }}">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{
            font-family: Arial, Helvetica, sans-serif;
            background:#0b0b0b;
            color:#fff;
            overflow-x:hidden;
        }
        a{text-decoration:none;}
        .dashboard-page{
            min-height:100vh;
            background:linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)), #0b0b0b;
        }
        .hero{
            position:relative;
            min-height:92vh;
            display:flex;
            align-items:center;
            padding:60px 6%;
            background:
                linear-gradient(to right, rgba(0,0,0,0.88) 30%, rgba(0,0,0,0.45) 60%, rgba(0,0,0,0.7) 100%),
                url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=1600&q=80');
            background-size:cover;
            background-position:center;
        }
        .hero-content{max-width:650px;}
        .hero-tag{
            display:inline-block;
            background:rgba(229, 9, 20, 0.18);
            border:1px solid rgba(229, 9, 20, 0.45);
            color:#ffb3b8;
            padding:8px 14px;
            border-radius:999px;
            font-size:13px;
            margin-bottom:20px;
            letter-spacing:.5px;
        }
        .hero h1{
            font-size:64px;
            line-height:1.05;
            font-weight:900;
            margin-bottom:18px;
        }
        .hero p{
            font-size:18px;
            line-height:1.8;
            color:#d4d4d4;
            margin-bottom:28px;
            max-width:580px;
        }
        .hero-buttons{
            display:flex;
            gap:14px;
            flex-wrap:wrap;
        }
        .hero-btn{
            padding:14px 24px;
            border-radius:8px;
            font-size:16px;
            font-weight:700;
            transition:.3s ease;
            display:inline-flex;
            align-items:center;
            justify-content:center;
        }
        .hero-btn-primary{background:#e50914;color:#fff;}
        .hero-btn-primary:hover{background:#b20710;transform:translateY(-2px);}
        .hero-btn-secondary{
            background:rgba(255,255,255,0.12);
            color:#fff;
            border:1px solid rgba(255,255,255,0.16);
        }
        .hero-btn-secondary:hover{background:rgba(255,255,255,0.2);transform:translateY(-2px);}
        .section{padding:55px 6%;}
        .section-title{font-size:30px;font-weight:800;margin-bottom:24px;}
        .section-subtitle{
            color:#bbbbbb;
            margin-bottom:30px;
            font-size:16px;
            line-height:1.7;
        }
        .featured-grid{
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:24px;
        }
        .featured-card{
            position:relative;
            min-height:420px;
            border-radius:18px;
            overflow:hidden;
            background:#151515;
            box-shadow:0 12px 35px rgba(0,0,0,0.35);
            transition:.35s ease;
        }
        .featured-card:hover{transform:translateY(-8px);}
        .featured-card img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
        }
        .featured-overlay{
            position:absolute;
            inset:0;
            background:linear-gradient(to top, rgba(0,0,0,0.92), rgba(0,0,0,0.15));
            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            padding:24px;
        }
        .featured-badge{
            display:inline-block;
            width:max-content;
            padding:6px 12px;
            border-radius:999px;
            background:#e50914;
            font-size:12px;
            font-weight:700;
            margin-bottom:12px;
        }
        .featured-overlay h3{font-size:24px;margin-bottom:10px;}
        .featured-overlay p{color:#d3d3d3;font-size:14px;line-height:1.7;}
        .poster-row{
            display:grid;
            grid-template-columns:repeat(6, 1fr);
            gap:18px;
        }
        .poster-card{
            background:#121212;
            border-radius:14px;
            overflow:hidden;
            transition:.3s ease;
            box-shadow:0 8px 20px rgba(0,0,0,0.25);
        }
        .poster-card:hover{transform:scale(1.04);}
        .poster-image{
            width:100%;
            height:290px;
            object-fit:cover;
            display:block;
            background:#1a1a1a;
        }
        .poster-info{padding:14px;}
        .poster-info h4{font-size:16px;margin-bottom:8px;}
        .poster-info span{color:#b5b5b5;font-size:13px;}
        .two-column{
            display:grid;
            grid-template-columns:1.2fr .8fr;
            gap:28px;
            align-items:center;
        }
        .info-box{
            background:linear-gradient(135deg, #161616, #101010);
            border:1px solid rgba(255,255,255,0.06);
            border-radius:20px;
            padding:32px;
            box-shadow:0 10px 30px rgba(0,0,0,0.3);
        }
        .info-box h3{font-size:30px;margin-bottom:16px;}
        .info-box p{color:#cfcfcf;line-height:1.8;margin-bottom:18px;}
        .feature-list{
            display:grid;
            grid-template-columns:repeat(2, 1fr);
            gap:14px;
            margin-top:18px;
        }
        .feature-item{
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
            border-radius:12px;
            padding:16px;
            color:#eaeaea;
            font-size:14px;
        }
        .promo-image{
            width:100%;
            border-radius:20px;
            object-fit:cover;
            min-height:430px;
            box-shadow:0 12px 35px rgba(0,0,0,0.35);
        }
        .plans{
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:22px;
        }
        .plan-card{
            background:linear-gradient(180deg, #151515, #0f0f0f);
            border-radius:18px;
            padding:28px;
            border:1px solid rgba(255,255,255,0.08);
            transition:.3s ease;
        }
        .plan-card:hover{
            transform:translateY(-7px);
            border-color:rgba(229,9,20,0.4);
        }
        .plan-card.featured{
            border:1px solid rgba(229,9,20,0.55);
            box-shadow:0 10px 30px rgba(229,9,20,0.15);
        }
        .plan-card h3{font-size:24px;margin-bottom:10px;}
        .plan-price{
            font-size:34px;
            font-weight:900;
            color:#e50914;
            margin-bottom:16px;
        }
        .plan-card p{
            color:#cfcfcf;
            line-height:1.7;
            margin-bottom:18px;
            min-height:48px;
        }
        .plan-btn{
            display:inline-block;
            width:100%;
            text-align:center;
            padding:13px;
            border-radius:10px;
            font-weight:700;
            background:#e50914;
            color:#fff;
            transition:.3s ease;
        }
        .plan-btn:hover{background:#b20710;}
        .category-section{margin-bottom:50px;}
        .cta-box{
            text-align:center;
            background:linear-gradient(135deg, rgba(229,9,20,0.18), rgba(255,255,255,0.04));
            border:1px solid rgba(229,9,20,0.25);
            border-radius:22px;
            padding:45px 30px;
        }
        .cta-box h2{font-size:38px;margin-bottom:14px;}
        .cta-box p{
            max-width:700px;
            margin:0 auto 22px;
            color:#dddddd;
            line-height:1.8;
        }
        .empty-box{
            background:#141414;
            border:1px solid rgba(255,255,255,0.08);
            border-radius:16px;
            padding:24px;
            color:#ccc;
        }
        @media (max-width:1200px){
            .poster-row{grid-template-columns:repeat(3, 1fr);}
            .featured-grid{grid-template-columns:1fr 1fr;}
        }
        @media (max-width:992px){
            .hero h1{font-size:48px;}
            .two-column,.plans,.featured-grid{grid-template-columns:1fr;}
        }
        @media (max-width:768px){
            .hero{min-height:80vh;padding:40px 5%;}
            .hero h1{font-size:38px;}
            .hero p{font-size:16px;}
            .poster-row{grid-template-columns:repeat(2, 1fr);}
            .feature-list{grid-template-columns:1fr;}
            .section-title{font-size:26px;}
        }
        @media (max-width:500px){
            .poster-row{grid-template-columns:1fr;}
            .hero-buttons{flex-direction:column;}
            .hero-btn{width:100%;}
        }
    </style>
</head>
<body>
<div class="dashboard-page">
    @include('layouts.navigation')

    <section class="hero">
            <div class="hero-content">
                <div class="hero-tag">Unlimited movies, series, and entertainment</div>
                <h1>Welcome to Horizon Streaming Experience</h1>
                <p>
                    Discover premium entertainment, featured videos, trending stories, and exclusive content
                    all in one place. Horizon gives your audience a modern streaming platform with smooth access,
                    cinematic style, and a rich digital watching experience.
                </p>

                <div class="hero-buttons">
                    <a href="/videos" class="hero-btn hero-btn-primary">Watch Now</a>
                    <a href="/plans" class="hero-btn hero-btn-secondary">View Plans</a>
                </div>
            </div>
        </section>

    <section class="section">
        <h2 class="section-title">Featured Specials</h2>
        <p class="section-subtitle">Freshly published videos from your real Horizon library.</p>

        @if($featuredVideos->count())
            <div class="featured-grid">
                @foreach($featuredVideos as $video)
                    <a href="{{ route('videos.show', $video) }}" class="featured-card">
                        @if($video->poster_path)
                            <img src="{{ $video->poster_path }}" alt="{{ $video->title }}">
                        @else
                            <img src="https://via.placeholder.com/800x1200/111111/cccccc?text=No+Poster" alt="{{ $video->title }}">
                        @endif

                        <div class="featured-overlay">
                            <span class="featured-badge">
                                {{ $video->categories->first()->name ?? 'Featured' }}
                            </span>
                            <h3>{{ $video->title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($video->description ?: 'No description available.', 110) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-box">No featured videos found yet.</div>
        @endif
    </section>

    <section class="section">
        <h2 class="section-title">Trending Now</h2>

        @if($trendingVideos->count())
            <div class="poster-row">
                @foreach($trendingVideos as $video)
                    <a href="{{ route('videos.show', $video) }}" class="poster-card">
                        @if($video->poster_path)
                            <img class="poster-image" src="{{ $video->poster_path }}" alt="{{ $video->title }}">
                        @else
                            <img class="poster-image" src="https://via.placeholder.com/600x900/111111/cccccc?text=No+Poster" alt="{{ $video->title }}">
                        @endif

                        <div class="poster-info">
                            <h4>{{ $video->title }}</h4>
                            <span>
                                {{ $video->categories->pluck('name')->take(2)->implode(' • ') ?: 'Video' }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-box">No trending videos available yet.</div>
        @endif
    </section>

    <section class="section">
    <div class="two-column">
        <div class="info-box">
            @if($oldestVideo)
                <h3>{{ $oldestVideo->title }}</h3>

                <p>
                    {{ $oldestVideo->description ?: 'No description available for this video yet.' }}
                </p>

                <div class="feature-list">
                    <div class="feature-item">
                        <strong>Title:</strong> {{ $oldestVideo->title }}
                    </div>

                    <div class="feature-item">
                        <strong>Categories:</strong>
                        {{ $oldestVideo->categories->pluck('name')->implode(', ') ?: 'Uncategorized' }}
                    </div>

                    @if($oldestVideo->duration_seconds)
                        <div class="feature-item">
                            <strong>Duration:</strong> {{ gmdate('H:i:s', $oldestVideo->duration_seconds) }}
                        </div>
                    @endif

                    <div class="feature-item">
                        <strong>Added:</strong>
                        {{ $oldestVideo->created_at ? $oldestVideo->created_at->format('d M Y') : '-' }}
                    </div>
                </div>

                <div style="margin-top:20px;">
                    <a href="{{ route('videos.show', $oldestVideo) }}" class="hero-btn hero-btn-primary">
                        Watch This Video
                    </a>
                </div>
            @else
                <h3>Enjoy Horizon on Every Screen</h3>
                <p>
                    Watch your real uploaded videos across devices with a clean streaming layout,
                    featured sections, category shelves, and subscription-ready presentation.
                </p>

                <div class="feature-list">
                    <div class="feature-item">{{ $featuredVideos->count() }} featured videos on homepage</div>
                    <div class="feature-item">{{ $trendingVideos->count() }} trending video slots</div>
                    <div class="feature-item">{{ $categories->count() }} available categories</div>
                    <div class="feature-item">{{ $plans->count() }} active subscription plans</div>
                </div>
            @endif
        </div>

        <div>
            @if($oldestVideo && $oldestVideo->poster_path)
                <img
                    class="promo-image"
                    src="{{ $oldestVideo->poster_path }}"
                    alt="{{ $oldestVideo->title }}"
                >
            @else
                <img
                    class="promo-image"
                    src="https://images.unsplash.com/photo-1585951237318-9ea5e175b891?auto=format&fit=crop&w=1000&q=80"
                    alt="Streaming promo"
                >
            @endif
        </div>
    </div>
</section>

    @foreach($categories->take(4) as $category)
        @if($category->videos->count())
            <section class="section category-section">
                <h2 class="section-title">{{ $category->name }}</h2>
                <div class="poster-row">
                    @foreach($category->videos->take(6) as $video)
                        <a href="{{ route('videos.show', $video) }}" class="poster-card">
                            @if($video->poster_path)
                                <img class="poster-image" src="{{ $video->poster_path }}" alt="{{ $video->title }}">
                            @else
                                <img class="poster-image" src="https://via.placeholder.com/600x900/111111/cccccc?text=No+Poster" alt="{{ $video->title }}">
                            @endif

                            <div class="poster-info">
                                <h4>{{ $video->title }}</h4>
                                <span>{{ \Illuminate\Support\Str::limit($video->description ?: 'No description available.', 50) }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    @endforeach

    <section class="section">
        <h2 class="section-title">Choose Your Plan</h2>
        <p class="section-subtitle">Live plans loaded from your database.</p>

        @if($plans->count())
            <div class="plans">
                @foreach($plans as $index => $plan)
                    <div class="plan-card {{ $index === 1 ? 'featured' : '' }}">
                        <h3>{{ $plan->name }}</h3>
                        <div class="plan-price">
                            {{ $plan->currency }} {{ number_format($plan->price_cents) }}
                        </div>

                        <p>{{ $plan->description ?: 'Premium access for Horizon members.' }}</p>

                        <a href="{{ route('subscribe.index') }}" class="plan-btn">Choose Plan</a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-box">No active plans found yet.</div>
        @endif
    </section>

    <section class="section">
        <div class="cta-box">
            <h2>Start Streaming with Horizon Today</h2>
            <p>
                Explore your latest uploads, browse categories, and discover premium video content
                directly from your real database records.
            </p>
            <a href="{{ route('videos.index') }}" class="hero-btn hero-btn-primary">Explore Videos</a>
        </div>
    </section>

    @include('layouts.footer')
</div>
</body>
</html>