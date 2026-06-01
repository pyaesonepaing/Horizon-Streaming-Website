<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Horizon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        .auth-page{
            min-height:100vh;
            background:
                linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)),
                #0b0b0b;
        }

        .auth-hero{
            position:relative;
            padding:90px 6% 55px;
            background:
                linear-gradient(to right, rgba(0,0,0,0.9) 25%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.82) 100%),
                url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?auto=format&fit=crop&w=1600&q=80');
            background-size:cover;
            background-position:center;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .auth-hero-content{
            max-width:760px;
        }

        .auth-tag{
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

        .auth-hero h1{
            margin:0 0 14px;
            font-size:52px;
            font-weight:900;
            line-height:1.08;
        }

        .auth-hero p{
            margin:0;
            color:#d6d6d6;
            max-width:680px;
            font-size:16px;
            line-height:1.8;
        }

        .page-section{
            max-width:1200px;
            margin:0 auto;
            padding:40px 6% 70px;
        }

        .auth-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:28px;
            align-items:start;
        }

        .auth-info-card,
        .auth-form-card{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            overflow:hidden;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
        }

        .auth-info-content,
        .auth-form-content{
            padding:28px;
        }

        .auth-info-card h2,
        .auth-form-card h2{
            margin:0 0 14px;
            font-size:30px;
            font-weight:900;
        }

        .auth-info-card p,
        .auth-form-card p{
            margin:0 0 18px;
            color:#cfcfcf;
            line-height:1.8;
            font-size:15px;
        }

        .feature-list{
            display:flex;
            flex-direction:column;
            gap:14px;
            margin-top:20px;
        }

        .feature-item{
            padding:16px 18px;
            border-radius:16px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
            color:#e5e5e5;
            line-height:1.7;
            font-size:14px;
        }

        .alert{
            margin-bottom:18px;
            border-radius:14px;
            padding:16px 18px;
            font-size:14px;
            line-height:1.7;
        }

        .alert-success{
            background:rgba(34,197,94,0.12);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .alert-error{
            background:rgba(239,68,68,0.12);
            border:1px solid rgba(239,68,68,0.35);
            color:#ffb4b4;
        }

        .alert-error ul{
            margin:0;
            padding-left:18px;
        }

        .form-group{
            margin-bottom:18px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            font-size:14px;
            font-weight:700;
            color:#e2e2e2;
        }

        .form-control{
            width:100%;
            background:#0e0e0e;
            border:1px solid rgba(255,255,255,0.12);
            color:#fff;
            border-radius:12px;
            padding:14px 15px;
            font-size:14px;
            outline:none;
            transition:.3s ease;
        }

        .form-control:focus{
            border-color:#e50914;
            box-shadow:0 0 0 3px rgba(229,9,20,0.12);
        }

        .form-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:14px;
            margin-bottom:20px;
            flex-wrap:wrap;
        }

        .remember-wrap{
            display:inline-flex;
            align-items:center;
            gap:10px;
            color:#d3d3d3;
            font-size:14px;
        }

        .remember-wrap input{
            accent-color:#e50914;
            width:16px;
            height:16px;
        }

        .helper-link{
            color:#ffb3b8;
            font-size:14px;
        }

        .helper-link:hover{
            text-decoration:underline;
        }

        .btn-primary{
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
            background:#e50914;
            color:#fff;
            border:1px solid #e50914;
        }

        .btn-primary:hover{
            background:#b20710;
            border-color:#b20710;
        }

        .bottom-text{
            margin-top:22px;
            text-align:center;
            color:#bfbfbf;
            font-size:14px;
            line-height:1.8;
        }

        .bottom-text a{
            color:#ffb3b8;
            font-weight:700;
        }

        .bottom-text a:hover{
            text-decoration:underline;
        }

        .back-link{
            display:inline-block;
            margin-top:18px;
            color:#a9a9a9;
            font-size:13px;
        }

        .back-link:hover{
            color:#fff;
            text-decoration:underline;
        }

        @media (max-width:992px){
            .auth-grid{
                grid-template-columns:1fr;
            }

            .auth-hero h1{
                font-size:40px;
            }
        }

        @media (max-width:768px){
            .auth-hero{
                padding:72px 5% 45px;
            }

            .auth-hero h1{
                font-size:32px;
            }

            .auth-hero p{
                font-size:15px;
            }

            .page-section{
                padding:28px 5% 50px;
            }

            .auth-info-content,
            .auth-form-content{
                padding:20px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-page">
        @include('layouts.navigation')

        <section class="auth-hero">
            <div class="auth-hero-content">
                <span class="auth-tag">Welcome Back to Horizon</span>
                <h1>Login to Your Account</h1>
                <p>
                    Sign in to continue watching videos, manage your subscription,
                    access premium downloads, and enjoy the full Horizon experience.
                </p>
            </div>
        </section>

        <main class="page-section">
            <div class="auth-grid">
                <div class="auth-info-card">
                    <div class="auth-info-content">
                        <h2>Why Sign In?</h2>
                        <p>
                            Logging in gives you access to your account dashboard, subscription features,
                            profile settings, and premium Horizon content.
                        </p>

                        <div class="feature-list">
                            <div class="feature-item">Watch and manage your Horizon account in one place.</div>
                            <div class="feature-item">Access subscription plans and premium download options.</div>
                            <div class="feature-item">Track your profile, activity, and personalized content.</div>
                            <div class="feature-item">Stay connected with a modern streaming experience.</div>
                        </div>
                    </div>
                </div>

                <div class="auth-form-card">
                    <div class="auth-form-content">
                        <h2>Sign In</h2>
                        <p>Enter your account credentials to continue.</p>

                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-error">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    class="form-control"
                                    placeholder="Enter your email"
                                >
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    class="form-control"
                                    placeholder="Enter your password"
                                >
                            </div>

                            <div class="form-row">
                                <label for="remember_me" class="remember-wrap">
                                    <input
                                        id="remember_me"
                                        type="checkbox"
                                        name="remember"
                                    >
                                    <span>Remember me</span>
                                </label>

                                @if(Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="helper-link">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="btn-primary">
                                Log In
                            </button>
                        </form>

                        <div class="bottom-text">
                            Don’t have an account?
                            <a href="{{ route('register') }}">Register</a>
                        </div>

                        <div class="bottom-text">
                            <a href="{{ route('home') }}" class="back-link">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>