<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Plans - Horizon</title>
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

        .plans-page{
            min-height:100vh;
            background:
                linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)),
                #0b0b0b;
        }

        .plans-hero{
            position:relative;
            padding:90px 6% 55px;
            background:
                linear-gradient(to right, rgba(0,0,0,0.9) 25%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.82) 100%),
                url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=1600&q=80');
            background-size:cover;
            background-position:center;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .plans-hero-content{
            max-width:760px;
        }

        .plans-tag{
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

        .plans-hero h1{
            margin:0 0 14px;
            font-size:52px;
            font-weight:900;
            line-height:1.08;
        }

        .plans-hero p{
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

        .section-head{
            margin-bottom:28px;
        }

        .section-head h2{
            margin:0 0 10px;
            font-size:30px;
            font-weight:800;
        }

        .section-head p{
            margin:0;
            color:#bdbdbd;
            line-height:1.8;
            font-size:15px;
        }

        .flash-box{
            margin-bottom:20px;
            border-radius:14px;
            padding:16px 18px;
            font-size:14px;
            line-height:1.7;
        }

        .flash-success{
            background:rgba(34,197,94,0.12);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .flash-error{
            background:rgba(239,68,68,0.12);
            border:1px solid rgba(239,68,68,0.35);
            color:#ffb4b4;
        }

        .plans-grid{
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:24px;
        }

        .plan-card{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            padding:28px;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
            transition:.3s ease;
            position:relative;
            overflow:hidden;
        }

        .plan-card:hover{
            transform:translateY(-8px);
            border-color:rgba(229,9,20,0.4);
        }

        .plan-card.featured{
            border-color:rgba(229,9,20,0.55);
            box-shadow:0 14px 40px rgba(229,9,20,0.14);
        }

        .plan-card.current-plan{
            border-color:rgba(34,197,94,0.45);
            box-shadow:0 14px 40px rgba(34,197,94,0.10);
        }

        .plan-badge{
            display:inline-block;
            margin-bottom:16px;
            padding:7px 12px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
            background:rgba(229,9,20,0.16);
            border:1px solid rgba(229,9,20,0.35);
            color:#ffb3b8;
        }

        .plan-badge.current{
            background:rgba(34,197,94,0.16);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .plan-title{
            margin:0 0 10px;
            font-size:28px;
            font-weight:900;
        }

        .plan-description{
            color:#cfcfcf;
            line-height:1.8;
            font-size:14px;
            min-height:72px;
            margin-bottom:16px;
        }

        .plan-price{
            font-size:38px;
            font-weight:900;
            color:#e50914;
            margin-bottom:6px;
        }

        .plan-interval{
            color:#b8b8b8;
            font-size:14px;
            margin-bottom:22px;
        }

        .plan-features{
            display:flex;
            flex-direction:column;
            gap:12px;
            margin-bottom:24px;
        }

        .plan-feature{
            padding:12px 14px;
            border-radius:14px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
            color:#e2e2e2;
            font-size:14px;
        }

        .plan-action form{
            margin:0;
        }

        .btn-primary,
        .btn-secondary{
            width:100%;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:14px 18px;
            border-radius:12px;
            font-size:14px;
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
            background:transparent;
            color:#fff;
            border:1px solid rgba(255,255,255,0.16);
        }

        .btn-secondary:hover{
            background:rgba(255,255,255,0.08);
        }

        .btn-secondary[disabled]{
            opacity:1;
            cursor:not-allowed;
        }

        .btn-current[disabled]{
            border-color:rgba(34,197,94,0.35);
            color:#b7f7c7;
            background:rgba(34,197,94,0.08);
        }

        .btn-locked[disabled]{
            border-color:rgba(255,255,255,0.12);
            color:#9ca3af;
            background:rgba(255,255,255,0.04);
        }

        .cancel-box{
            margin-bottom:28px;
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            padding:26px;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
        }

        .cancel-box h3{
            margin:0 0 10px;
            font-size:24px;
            font-weight:800;
        }

        .cancel-box p{
            margin:0 0 18px;
            color:#c9c9c9;
            line-height:1.8;
            font-size:14px;
        }

        .empty-box{
            background:#141414;
            border:1px solid rgba(255,255,255,0.08);
            border-radius:18px;
            padding:50px 24px;
            text-align:center;
            color:#bdbdbd;
        }

        @media (max-width:1100px){
            .plans-grid{
                grid-template-columns:repeat(2, 1fr);
            }
        }

        @media (max-width:768px){
            .plans-hero{
                padding:72px 5% 45px;
            }

            .plans-hero h1{
                font-size:34px;
            }

            .plans-hero p{
                font-size:15px;
            }

            .page-section{
                padding:28px 5% 50px;
            }

            .plans-grid{
                grid-template-columns:1fr;
            }

            .plan-description{
                min-height:auto;
            }
        }
    </style>
</head>
<body>
    <div class="plans-page">
        @include('layouts.navigation')

        <section class="plans-hero">
            <div class="plans-hero-content">
                <span class="plans-tag">Premium Access on Horizon</span>
                <h1>Subscription Plans</h1>
                <p>
                    Choose the plan that fits your viewing experience. Watch content freely and unlock
                    premium download access with an active Horizon subscription.
                </p>
            </div>
        </section>

        <main class="page-section">
            @if(session('success'))
                <div class="flash-box flash-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="flash-box flash-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="section-head">
                <h2>Available Plans</h2>
                <p>
                    Flexible pricing for different types of viewers. You must cancel your current subscription
                    before choosing another plan.
                </p>
            </div>

            @if($activeSubscription)
                <div class="cancel-box">
                    <h3>Your Current Subscription</h3>
                    <p>
                        You are currently subscribed to
                        <strong>{{ $activeSubscription->plan->name }}</strong>.<br>
                        Start date:
                        <strong>{{ $activeSubscription->starts_at?->format('d M Y') }}</strong><br>
                        End date:
                        <strong>{{ $activeSubscription->ends_at?->format('d M Y') }}</strong><br>
                        @if($activeSubscription->payments->count())
                            Latest payment:
                            <strong>
                                {{ $activeSubscription->payments->sortByDesc('paid_at')->first()->currency }}
                                {{ number_format($activeSubscription->payments->sortByDesc('paid_at')->first()->amount_cents / 100, 2) }}
                            </strong>
                        @endif
                    </p>

                    <form method="POST" action="{{ route('subscribe.cancel') }}">
                        @csrf
                        <button type="submit" class="btn-secondary">
                            Cancel Active Subscription
                        </button>
                    </form>
                </div>
            @elseif(!empty($pendingSubscription))
                <div class="cancel-box">
                    <h3>Your Subscription Request Is Pending</h3>
                    <p>
                        You submitted a payment form for
                        <strong>{{ $pendingSubscription->plan->name }}</strong>.<br>
                        Submitted on:
                        <strong>{{ $pendingSubscription->created_at?->format('d M Y H:i') }}</strong><br>
                        Please wait for admin approval, or cancel this request.
                    </p>

                    <form method="POST" action="{{ route('subscribe.cancel') }}">
                        @csrf
                        <button type="submit" class="btn-secondary">
                            Cancel Pending Request
                        </button>
                    </form>
                </div>
            @endif

            @if($plans->count())
                <div class="plans-grid">
                    @foreach($plans as $index => $plan)
                        <div class="plan-card {{ $index === 1 ? 'featured' : '' }} {{ $activeSubscription && $activeSubscription->plan_id == $plan->id ? 'current-plan' : '' }}">
                            <span class="plan-badge {{ $activeSubscription && $activeSubscription->plan_id == $plan->id ? 'current' : '' }}">
                                @if($activeSubscription && $activeSubscription->plan_id == $plan->id)
                                    Current Plan
                                @elseif($index === 1)
                                    Most Popular
                                @else
                                    Horizon Plan
                                @endif
                            </span>

                            <h3 class="plan-title">{{ $plan->name }}</h3>

                            <p class="plan-description">
                                {{ $plan->description ?: 'Enjoy premium Horizon access with a smooth streaming and download experience.' }}
                            </p>

                            <div class="plan-price">
                                {{ $plan->currency }} {{ number_format($plan->price_cents) }}
                            </div>

                            <div class="plan-interval">
                                every {{ $plan->interval_count }} {{ \Illuminate\Support\Str::plural($plan->interval, $plan->interval_count) }}
                            </div>

                            <div class="plan-features">
                                <div class="plan-feature">Watch Horizon content anytime</div>
                                <div class="plan-feature">Subscription-based premium access</div>
                                <div class="plan-feature">Unlock downloadable videos</div>
                                <div class="plan-feature">Manage your plan easily</div>
                            </div>

                            <div class="plan-action">
                                @if($activeSubscription && $activeSubscription->plan_id == $plan->id)
                                    <button type="button" class="btn-secondary btn-current" disabled>
                                        Current Plan
                                    </button>
                                @elseif(!empty($pendingSubscription) && $pendingSubscription->plan_id == $plan->id)
                                    <button type="button" class="btn-secondary btn-current" disabled>
                                        Pending Approval
                                    </button>
                                @elseif($activeSubscription || !empty($pendingSubscription))
                                    <button type="button" class="btn-secondary btn-locked" disabled>
                                        Unavailable
                                    </button>
                                @else
                                    <a href="{{ route('subscribe.checkout', $plan) }}" class="btn-primary">
                                        Subscribe
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-box">
                    No subscription plans are available right now.
                </div>
            @endif
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>