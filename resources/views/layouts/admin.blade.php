<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Horizon</title>
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

        .admin-page{
            min-height:100vh;
            display:flex;
            background:
                linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)),
                #0b0b0b;
        }

        .admin-sidebar{
            width:280px;
            min-height:100vh;
            background:linear-gradient(180deg, #101010, #0a0a0a);
            border-right:1px solid rgba(255,255,255,0.08);
            padding:28px 22px;
            position:sticky;
            top:0;
        }

        .admin-brand{
            margin-bottom:38px;
        }

        .admin-brand h1{
            margin:0;
            font-size:50px;
            text-align: center;
            font-weight:900;
            color:#e50914;
            letter-spacing:.5px;
        }

        .admin-brand p{
            margin:8px 0 0;
            text-align: center;
            color:#a8a8a8;
            font-size:18px;
            line-height:1.7;
        }

        .admin-user-box{
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
            border-radius:18px;
            padding:16px 10px;
            margin-bottom:24px;
        }

        .admin-user-box strong{
            display:block;
            color:#fff;
            margin-bottom:6px;
            font-size:15px;
        }

        .admin-user-box span{
            color:#bdbdbd;
            font-size:13px;
            line-height:1.6;
            word-break:break-word;
        }

        .admin-nav{
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .admin-nav a{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            padding:14px 16px;
            border-radius:14px;
            color:#e5e5e5;
            background:transparent;
            border:1px solid transparent;
            transition:.3s ease;
            font-size:14px;
            font-weight:600;
        }

        .admin-nav a:hover{
            background:rgba(255,255,255,0.05);
            border-color:rgba(255,255,255,0.08);
            color:#fff;
        }

        .admin-nav a.active{
            background:rgba(229,9,20,0.12);
            border-color:rgba(229,9,20,0.30);
            color:#ffb3b8;
        }

        .admin-nav .nav-badge{
            font-size:11px;
            padding:5px 9px;
            border-radius:999px;
            background:rgba(255,255,255,0.06);
            color:#cfcfcf;
        }

        .admin-nav a.active .nav-badge{
            background:rgba(229,9,20,0.18);
            color:#ffb3b8;
        }

        .admin-sidebar-footer{
            margin-top:26px;
            padding-top:20px;
            border-top:1px solid rgba(255,255,255,0.08);
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .admin-sidebar-footer a,
        .admin-sidebar-footer button{
            width:100%;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:12px 14px;
            border-radius:12px;
            font-size:14px;
            font-weight:700;
            transition:.3s ease;
            cursor:pointer;
        }

        .admin-site-btn{
            background:transparent;
            color:#fff;
            border:1px solid rgba(255,255,255,0.14);
        }

        .admin-site-btn:hover{
            background:rgba(255,255,255,0.08);
        }

        .admin-logout-btn{
            background:#e50914;
            color:#fff;
            border:1px solid #e50914;
        }

        .admin-logout-btn:hover{
            background:#b20710;
            border-color:#b20710;
        }

        .admin-main{
            flex:1;
            min-width:0;
            padding:30px;
        }

        .admin-topbar{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:16px;
            margin-bottom:26px;
            flex-wrap:wrap;
        }

        .admin-topbar h2{
            margin:0;
            font-size:34px;
            font-weight:900;
        }

        .admin-topbar p{
            margin:8px 0 0;
            color:#b5b5b5;
            font-size:14px;
            line-height:1.7;
        }

        .admin-topbar-right{
            display:flex;
            align-items:center;
            gap:12px;
            flex-wrap:wrap;
        }

        .top-pill{
            padding:9px 14px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
            background:rgba(255,255,255,0.05);
            border:1px solid rgba(255,255,255,0.08);
            color:#d7d7d7;
        }

        .content-shell{
            background:linear-gradient(180deg, #121212, #0f0f0f);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            padding:24px;
            box-shadow:0 12px 34px rgba(0,0,0,0.30);
        }

        .flash-success,
        .flash-error{
            margin-bottom:18px;
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

        .flash-error ul{
            margin:0;
            padding-left:18px;
        }

        @media (max-width: 1024px){
            .admin-page{
                flex-direction:column;
            }

            .admin-sidebar{
                width:100%;
                min-height:auto;
                position:relative;
                border-right:none;
                border-bottom:1px solid rgba(255,255,255,0.08);
            }

            .admin-main{
                padding:20px;
            }
        }

        @media (max-width: 768px){
            .admin-main{
                padding:16px;
            }

            .content-shell{
                padding:18px;
                border-radius:18px;
            }

            .admin-topbar h2{
                font-size:28px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-page">
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <h1>Horizon</h1>
                <p>Admin Panel</p>
            </div>

            <div class="admin-user-box">
                <strong>Name: <span>{{ auth()->user()->name ?? 'Admin User' }}</span></strong>
                <strong>Email: <span>{{ auth()->user()->email ?? 'admin@horizon.test' }}</span></strong>
            </div>

            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.videos.index') }}" class="{{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
                    <span>Videos</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <span>Categories</span>
                </a>

                <a href="{{ route('admin.plans.index') }}" class="{{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                    <span>Plans</span>
                </a>

                <a href="{{ route('admin.subscription-requests.index') }}" class="{{ request()->routeIs('admin.subscription-requests.*') ? 'active' : '' }}">
                    <span>Subscription Requests</span>
                    <span class="nav-badge">Payments</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span>Users</span>
                </a>

                <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <span>Contacts</span>
                </a>

                <a href="{{ route('admin.logs.index') }}" class="{{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                    <span>Audit Logs</span>
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="{{ route('home') }}" class="admin-site-btn">Back to Site</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="admin-logout-btn">Log Out</button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">

                <div class="admin-topbar-right">
                    <strong>Date: <span class="top-pill">{{ now()->format('d M Y') }}</span></strong>
                </div>
            </div>

            <div class="content-shell">
                @if(session('success'))
                    <div class="flash-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="flash-error">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="flash-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>