<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Horizon</title>
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

        .profile-edit-page{
            min-height:100vh;
            background:
                linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)),
                #0b0b0b;
        }

        .profile-edit-hero{
            position:relative;
            padding:90px 6% 55px;
            background:
                linear-gradient(to right, rgba(0,0,0,0.9) 25%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.82) 100%),
                url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80');
            background-size:cover;
            background-position:center;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .profile-edit-hero-content{
            max-width:760px;
        }

        .profile-edit-tag{
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

        .profile-edit-hero h1{
            margin:0 0 14px;
            font-size:52px;
            font-weight:900;
            line-height:1.08;
        }

        .profile-edit-hero p{
            margin:0;
            color:#d6d6d6;
            max-width:680px;
            font-size:16px;
            line-height:1.8;
        }

        .page-section{
            max-width:1350px;
            margin:0 auto;
            padding:36px 6% 60px;
        }

        .edit-grid{
            display:grid;
            grid-template-columns: 320px 1fr;
            gap:28px;
            align-items:start;
        }

        .side-card,
        .form-card{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            overflow:hidden;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
        }

        .side-card-content,
        .form-card-content{
            padding:28px;
        }

        .avatar-wrap{
            display:flex;
            flex-direction:column;
            align-items:center;
            text-align:center;
        }

        .avatar{
            width:100px;
            height:100px;
            border-radius:50%;
            background:linear-gradient(135deg, #e50914, #b20710);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:36px;
            font-weight:900;
            color:#fff;
            margin-bottom:16px;
            box-shadow:0 0 24px rgba(229,9,20,0.25);
        }

        .user-name{
            font-size:26px;
            font-weight:900;
            margin-bottom:6px;
        }

        .user-email{
            color:#bfbfbf;
            font-size:14px;
            word-break:break-word;
            margin-bottom:16px;
        }

        .mini-badge{
            display:inline-block;
            padding:8px 14px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.1);
            color:#e2e2e2;
            margin-bottom:18px;
        }

        .side-info{
            margin-top:18px;
            display:flex;
            flex-direction:column;
            gap:12px;
        }

        .side-info-box{
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
            border-radius:16px;
            padding:14px 16px;
        }

        .side-info-box strong{
            display:block;
            font-size:13px;
            color:#aaaaaa;
            margin-bottom:6px;
        }

        .side-info-box span{
            color:white;
            font-size:14px;
            line-height:1.6;
        }

        .forms-stack{
            display:flex;
            flex-direction:column;
            gap:24px;
        }

        .form-card h2{
            margin:0 0 10px;
            font-size:28px;
            font-weight:900;
        }

        .form-card p{
            color:#cfcfcf;
            line-height:1.8;
            font-size:14px;
        }

        .section-label{
            display:inline-block;
            margin-bottom:16px;
            padding:7px 12px;
            color: white;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
            background:rgba(229,9,20,0.16);
            border:1px solid rgba(229,9,20,0.35);
        }

        /* Make Breeze partial forms match the theme */
        .form-card input,
        .form-card textarea,
        .form-card select{
            width:100%;
            background:#0e0e0e !important;
            border:1px solid rgba(255,255,255,0.12) !important;
            color:#fff !important;
            border-radius:12px !important;
            padding:12px 14px !important;
            font-size:14px !important;
            outline:none !important;
            box-shadow:none !important;
        }

        .form-card input:focus,
        .form-card textarea:focus,
        .form-card select:focus{
            border-color:#e50914 !important;
            box-shadow:0 0 0 3px rgba(229,9,20,0.12) !important;
        }

        .form-card label{
            color:#e5e5e5 !important;
            font-weight:700 !important;
            margin-bottom:8px !important;
            display:inline-block;
        }

        .form-card .text-gray-600,
        .form-card .text-gray-700,
        .form-card .text-gray-800,
        .form-card .text-sm,
        .form-card .mt-2,
        .form-card .mt-1,
        .form-card .mt-4{
            color:#cfcfcf !important;
        }

        .form-card .text-red-600,
        .form-card .text-red-500{
            color:#ffb4b4 !important;
        }

        .form-card button,
        .form-card .inline-flex.items-center.px-4.py-2{
            background:#e50914 !important;
            color:#fff !important;
            border:1px solid #e50914 !important;
            border-radius:12px !important;
            padding:12px 18px !important;
            font-size:14px !important;
            font-weight:700 !important;
            transition:.3s ease !important;
            box-shadow:none !important;
        }

        .form-card button:hover,
        .form-card .inline-flex.items-center.px-4.py-2:hover{
            background:#b20710 !important;
            border-color:#b20710 !important;
        }

        .form-card .bg-white{
            background:transparent !important;
        }

        .form-card .shadow,
        .form-card .shadow-sm,
        .form-card .rounded-lg,
        .form-card .sm\:rounded-lg{
            box-shadow:none !important;
            border-radius:0 !important;
            background:transparent !important;
        }

        .form-card .border,
        .form-card .border-gray-200,
        .form-card .border-gray-300{
            border-color:rgba(255,255,255,0.08) !important;
        }

        .danger-zone{
            border:1px solid rgba(239,68,68,0.22) !important;
            border-radius:18px;
            padding:18px;
            background:rgba(239,68,68,0.05);
        }

        @media (max-width:992px){
            .edit-grid{
                grid-template-columns:1fr;
            }

            .profile-edit-hero h1{
                font-size:40px;
            }
        }

        @media (max-width:768px){
            .profile-edit-hero{
                padding:72px 5% 45px;
            }

            .profile-edit-hero h1{
                font-size:32px;
            }

            .profile-edit-hero p{
                font-size:15px;
            }

            .page-section{
                padding:28px 5% 50px;
            }

            .side-card-content,
            .form-card-content{
                padding:20px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-edit-page">
        @include('layouts.navigation')

        <section class="profile-edit-hero">
            <div class="profile-edit-hero-content">
                <span class="profile-edit-tag">Manage Your Horizon Account</span>
                <h1>Edit Profile</h1>
                <p>
                    Update your account information, change your password, and manage your Horizon account settings securely.
                </p>
            </div>
        </section>

        <main class="page-section">
            <div class="edit-grid">
                <aside class="side-card">
                    <div class="side-card-content">
                        <div class="avatar-wrap">
                            <div class="avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-email">{{ auth()->user()->email }}</div>
                            <span class="mini-badge">
                                {{ auth()->user()->is_admin ? 'Administrator' : 'Member' }}
                            </span>
                        </div>

                        <div class="side-info">
                            <div class="side-info-box">
                                <strong>Joined</strong>
                                <span>{{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '-' }}</span>
                            </div>

                            <div class="side-info-box">
                                <strong>Email Status</strong>
                                <span>{{ auth()->user()->email_verified_at ? 'Verified' : 'Not Verified' }}</span>
                            </div>

                            <div class="side-info-box">
                                <strong>Account Type</strong>
                                <span>{{ auth()->user()->is_admin ? 'Admin access enabled' : 'Standard user account' }}</span>
                            </div>
                        </div>
                    </div>
                </aside>

                <div class="forms-stack">
                    <section class="form-card">
                        <div class="form-card-content">
                            <span class="section-label">Profile Information</span>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </section>

                    <section class="form-card">
                        <div class="form-card-content">
                            <span class="section-label">Security</span>
                            @include('profile.partials.update-password-form')
                        </div>
                    </section>

                    <section class="form-card">
                        <div class="form-card-content danger-zone">
                            <span class="section-label">Danger Zone</span>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </section>
                </div>
            </div>
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>