<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Horizon</title>
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

        .profile-page{
            min-height:100vh;
            background:
                linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)),
                #0b0b0b;
        }

        .profile-hero{
            position:relative;
            padding:90px 6% 55px;
            background:
                linear-gradient(to right, rgba(0,0,0,0.9) 25%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.82) 100%),
                url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80');
            background-size:cover;
            background-position:center;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .profile-hero-content{
            max-width:760px;
        }

        .profile-tag{
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

        .profile-hero h1{
            margin:0 0 14px;
            font-size:52px;
            font-weight:900;
            line-height:1.08;
        }

        .profile-hero p{
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

        .profile-grid{
            display:grid;
            grid-template-columns: 1fr 2fr;
            gap:28px;
            align-items:start;
        }

        .profile-card,
        .details-card{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            overflow:hidden;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
        }

        .profile-card-content,
        .details-card-content{
            padding:28px;
        }

        .avatar-wrap{
            display:flex;
            flex-direction:column;
            align-items:center;
            text-align:center;
        }

        .avatar{
            width:110px;
            height:110px;
            border-radius:50%;
            background:linear-gradient(135deg, #e50914, #b20710);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:40px;
            font-weight:900;
            color:#fff;
            margin-bottom:18px;
            box-shadow:0 0 24px rgba(229,9,20,0.25);
        }

        .user-name{
            font-size:28px;
            font-weight:900;
            margin-bottom:6px;
        }

        .user-email{
            color:#bfbfbf;
            font-size:14px;
            margin-bottom:18px;
            word-break:break-word;
        }

        .status-badge{
            display:inline-block;
            padding:8px 14px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
            margin-bottom:20px;
        }

        .status-active{
            background:rgba(34,197,94,0.16);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        .status-normal{
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.1);
            color:#e2e2e2;
        }

        .profile-actions{
            display:flex;
            flex-direction:column;
            gap:12px;
            margin-top:12px;
            width:100%;
        }

        .btn-primary,
        .btn-secondary,
        .btn-danger{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:13px 18px;
            border-radius:12px;
            font-size:14px;
            font-weight:700;
            transition:.3s ease;
            cursor:pointer;
            width:100%;
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

        .btn-danger{
            background:transparent;
            color:#ffb4b4;
            border:1px solid rgba(239,68,68,0.25);
        }

        .btn-danger:hover{
            background:rgba(239,68,68,0.08);
        }

        .details-card h2{
            margin:0 0 20px;
            font-size:30px;
            font-weight:900;
        }

        .details-grid{
            display:grid;
            grid-template-columns:repeat(2, 1fr);
            gap:18px;
        }

        .detail-box{
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
            border-radius:18px;
            padding:18px;
        }

        .detail-label{
            display:block;
            font-size:13px;
            color:#a9a9a9;
            margin-bottom:8px;
        }

        .detail-value{
            font-size:16px;
            font-weight:700;
            color:#fff;
            line-height:1.6;
            word-break:break-word;
        }

        .wide-box{
            grid-column:1 / -1;
        }

        .section-note{
            margin-top:24px;
            color:#bfbfbf;
            line-height:1.8;
            font-size:14px;
        }

        .success-box{
            margin-bottom:20px;
            border-radius:14px;
            padding:16px 18px;
            font-size:14px;
            background:rgba(34,197,94,0.12);
            border:1px solid rgba(34,197,94,0.35);
            color:#b7f7c7;
        }

        @media (max-width:992px){
            .profile-grid{
                grid-template-columns:1fr;
            }

            .profile-hero h1{
                font-size:40px;
            }
        }

        @media (max-width:768px){
            .profile-hero{
                padding:72px 5% 45px;
            }

            .profile-hero h1{
                font-size:32px;
            }

            .profile-hero p{
                font-size:15px;
            }

            .page-section{
                padding:28px 5% 50px;
            }

            .profile-card-content,
            .details-card-content{
                padding:20px;
            }

            .details-grid{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>
<body>
    <div class="profile-page">
        @include('layouts.navigation')

        <section class="profile-hero">
            <div class="profile-hero-content">
                <span class="profile-tag">Your Horizon Account</span>
                <h1>My Profile</h1>
                <p>
                    View your account information, update your personal details,
                    and manage your Horizon profile settings.
                </p>
            </div>
        </section>

        <main class="page-section">
            @if(session('success'))
                <div class="success-box">
                    {{ session('success') }}
                </div>
            @endif

            <div class="profile-grid">
                <div class="profile-card">
                    <div class="profile-card-content">
                        <div class="avatar-wrap">
                            <div class="avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-email">{{ auth()->user()->email }}</div>

                            @if(auth()->user()->is_admin)
                                <span class="status-badge status-active">Administrator</span>
                            @else
                                <span class="status-badge status-normal">Member</span>
                            @endif
                        </div>

                        <div class="profile-actions">
                            <a href="{{ route('profile.edit') }}" class="btn-primary">
                                Edit Profile
                            </a>

                            <a href="{{ route('subscribe.index') }}" class="btn-secondary">
                                Manage Subscription
                            </a>

                            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">
                                    Delete Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="details-card">
                    <div class="details-card-content">
                        <h2>Account Details</h2>

                        <div class="details-grid">
                            <div class="detail-box">
                                <span class="detail-label">Full Name</span>
                                <div class="detail-value">{{ auth()->user()->name }}</div>
                            </div>

                            <div class="detail-box">
                                <span class="detail-label">Email Address</span>
                                <div class="detail-value">{{ auth()->user()->email }}</div>
                            </div>

                            <div class="detail-box">
                                <span class="detail-label">Role</span>
                                <div class="detail-value">
                                    {{ auth()->user()->is_admin ? 'Administrator' : 'User' }}
                                </div>
                            </div>

                            <div class="detail-box">
                                <span class="detail-label">Email Verified</span>
                                <div class="detail-value">
                                    {{ auth()->user()->email_verified_at ? 'Verified' : 'Not Verified' }}
                                </div>
                            </div>

                            <div class="detail-box">
                                <span class="detail-label">Joined</span>
                                <div class="detail-value">
                                    {{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '-' }}
                                </div>
                            </div>

                            <div class="detail-box">
                                <span class="detail-label">Last Updated</span>
                                <div class="detail-value">
                                    {{ auth()->user()->updated_at ? auth()->user()->updated_at->format('d M Y') : '-' }}
                                </div>
                            </div>

                            <div class="detail-box wide-box">
                                <span class="detail-label">Account Summary</span>
                                <div class="detail-value">
                                    Welcome to Horizon. This page gives you a quick overview of your account data and profile settings.
                                </div>
                            </div>
                        </div>

                        <div class="section-note">
                            Use the edit button to update your name, email, password, or other available account settings.
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>