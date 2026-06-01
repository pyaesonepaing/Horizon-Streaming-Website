<style>
    .hz-nav-links a,
.hz-mobile-menu a {
    text-decoration: none;
    color: #f5f5f5;
    font-size: 15px;
    font-weight: 500;
    transition: 0.3s ease;
    position: relative;
}

.hz-nav-links a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 0;
    height: 2px;
    background: #e50914;
    transition: 0.3s ease;
}

.hz-nav-links a:hover::after,
.hz-nav-links a.active::after {
    width: 100%;
}
</style>
<nav class="hz-navbar">
    <div class="hz-nav-container">
        <a href="{{ route('home') }}" class="hz-logo">
            <span class="hz-logo-text">Horizon</span>
        </a>

        <div class="hz-nav-links desktop-menu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

            <a href="{{ route('videos.index') }}" class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">
                Videos
            </a>

            @auth
                <a href="{{ route('subscribe.index') }}" class="{{ request()->routeIs('subscribe.*') ? 'active' : '' }}">
                    Subscription
                </a>
            @else
                <a href="{{ route('login') }}">
                    Subscription
                </a>
            @endauth

            <a href="{{ route('contact.create') }}" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">
                Contact Us
            </a>

            @auth
                <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
                    Profile
                </a>
            @endauth
        </div>

        <div class="hz-nav-right desktop-menu">
            @auth
                <div class="hz-user-box">
                    <div class="hz-user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="hz-user-info">
                        <span class="hz-user-name">{{ Auth::user()->name }}
                            @if(auth()->user()->hasActiveSubscription())
                                <span title="Premium User">⭐</span>
                            @endif
                        </span>
                        <span class="hz-user-email">{{ Auth::user()->email }}</span>
                    </div>

                    <div class="hz-dropdown">
                        <button class="hz-dropdown-btn" type="button">Account ▾</button>

                        <div class="hz-dropdown-menu">
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('admin.videos.index') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">
                                    Admin Panel
                                </a>
                            @endif
                            <a href="{{ route('profile.index') }}">Profile Settings</a>
                            <a href="{{ route('downloads.history') }}" class="{{ request()->routeIs('downloads.history') ? 'active' : '' }}">Downloads</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="hz-logout-btn">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            @guest
                <div class="hz-auth-links">
                    <a href="{{ route('login') }}" class="hz-login-btn">Login</a>
                    <a href="{{ route('register') }}" class="hz-register-btn">Register</a>
                </div>
            @endguest
        </div>

        <button class="hz-mobile-toggle" id="hzMobileToggle" aria-label="Toggle Menu">
            ☰
        </button>
    </div>

    <div class="hz-mobile-menu" id="hzMobileMenu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

        <a href="{{ route('videos.index') }}" class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">
            Videos
        </a>

        @auth
            <a href="{{ route('subscribe.index') }}" class="{{ request()->routeIs('subscribe.*') ? 'active' : '' }}">
                Subscription
            </a>
        @else
            <a href="{{ route('login') }}">Subscription</a>
        @endauth

        <a href="{{ route('contact.create') }}" class="{{ request()->routeIs('contact.*') ? 'active' : '' }}">
            Contact Us
        </a>

        @auth
            <a href="{{ route('profile.index') }}" class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
                Profile
            </a>

            <div class="hz-mobile-user">
                <div class="hz-mobile-user-name">{{ Auth::user()->name }}</div>
                <div class="hz-mobile-user-email">{{ Auth::user()->email }}</div>
            </div>

            <div class="hz-mobile-account">
                <button class="hz-dropdown-btn hz-mobile-dropdown-btn" type="button" id="hzMobileAccountToggle">
                    Account ▾
                </button>

                <div class="hz-dropdown-menu hz-mobile-dropdown-menu" id="hzMobileAccountMenu">
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">
                            Admin Panel
                        </a>
                    @endif
                    <a href="{{ route('profile.index') }}">Profile Settings</a>
                    <a href="{{ route('downloads.history') }}" class="{{ request()->routeIs('downloads.history') ? 'active' : '' }}">
                        Downloads
                    </a>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hz-mobile-logout">Log Out</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest
    </div>
</nav>

<style>
    * {
        box-sizing: border-box;
    }

    .hz-navbar {
        position: sticky;
        top: 0;
        z-index: 999;
        width: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.88), rgba(0,0,0,0.65));
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .hz-nav-container {
        max-width: 1350px;
        margin: 0 auto;
        padding: 16px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .hz-logo {
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .hz-logo-text {
        font-size: 30px;
        font-weight: 900;
        letter-spacing: 1px;
        color: #e50914;
        text-transform: uppercase;
    }

    .hz-nav-links {
        display: flex;
        align-items: center;
        gap: 28px;
        flex: 1;
        margin-left: 25px;
    }

    .hz-nav-links a,
    .hz-mobile-menu a {
        text-decoration: none;
        color: #f5f5f5;
        font-size: 15px;
        font-weight: 500;
        transition: 0.3s ease;
        position: relative;
    }

    .hz-nav-links a:hover,
    .hz-mobile-menu a:hover,
    .hz-nav-links a.active,
    .hz-mobile-menu a.active {
        color: #e50914;
    }

    .hz-nav-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .hz-user-box {
        display: flex;
        align-items: center;
        gap: 14px;
        position: relative;
    }

    .hz-user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e50914, #b20710);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        box-shadow: 0 0 15px rgba(229, 9, 20, 0.35);
    }

    .hz-user-info {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .hz-user-name {
        color: #fff;
        font-size: 14px;
        font-weight: 700;
    }

    .hz-user-email {
        color: #b3b3b3;
        font-size: 12px;
    }

    .hz-dropdown {
        position: relative;
    }

    .hz-dropdown-btn {
        background: #1f1f1f;
        color: #fff;
        border: 1px solid rgba(255,255,255,0.12);
        padding: 10px 14px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .hz-dropdown-btn:hover {
        background: #2a2a2a;
    }

    .hz-dropdown-menu {
        position: absolute;
        right: 0;
        top: 44px;
        width: 190px;
        background: #111;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 10px;
        display: none;
        box-shadow: 0 18px 40px rgba(0,0,0,0.45);
    }

    .hz-dropdown:hover .hz-dropdown-menu {
        display: block;
    }

    .hz-dropdown-menu a,
    .hz-logout-btn {
        display: block;
        width: 100%;
        text-align: left;
        text-decoration: none;
        color: #fff;
        background: transparent;
        border: none;
        padding: 11px 12px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .hz-dropdown-menu a:hover,
    .hz-logout-btn:hover {
        background: rgba(229, 9, 20, 0.15);
        color: #e50914;
    }

    .hz-auth-links {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .hz-login-btn,
    .hz-register-btn {
        text-decoration: none;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .hz-login-btn {
        color: #fff;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .hz-login-btn:hover {
        background: rgba(255,255,255,0.08);
    }

    .hz-register-btn {
        color: #fff;
        background: #e50914;
    }

    .hz-register-btn:hover {
        background: #b20710;
    }

    .hz-mobile-toggle {
        display: none;
        background: transparent;
        border: none;
        color: #fff;
        font-size: 28px;
        cursor: pointer;
    }

    .hz-mobile-menu {
        display: none;
        padding: 0 28px 22px;
        background: rgba(0,0,0,0.96);
        border-top: 1px solid rgba(255,255,255,0.08);
    }

    .hz-mobile-menu.show {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .hz-mobile-user {
        background: #181818;
        padding: 14px;
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .hz-mobile-user-name {
        color: #fff;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .hz-mobile-user-email {
        color: #aaa;
        font-size: 13px;
    }

    .hz-mobile-logout {
        width: 100%;
        padding: 12px;
        border: none;
        background: #e50914;
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }
.hz-mobile-account {
    position: relative;
}

.hz-mobile-dropdown-btn {
    width: 100%;
    text-align: left;
}

.hz-mobile-dropdown-menu {
    position: static;
    width: 100%;
    margin-top: 10px;
    display: none;
    box-shadow: none;
    border-radius: 10px;
    background: #111;
}

.hz-mobile-dropdown-menu.show {
    display: block;
}
    @media (max-width: 992px) {
        .desktop-menu {
            display: none !important;
        }

        .hz-mobile-toggle {
            display: block;
        }

        .hz-logo-text {
            font-size: 26px;
        }

        .hz-nav-container {
            padding: 16px 20px;
        }

        .hz-mobile-menu {
            padding: 0 20px 20px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('hzMobileToggle');
        const menu = document.getElementById('hzMobileMenu');
        const mobileAccountToggle = document.getElementById('hzMobileAccountToggle');
        const mobileAccountMenu = document.getElementById('hzMobileAccountMenu');

        if (toggle && menu) {
            toggle.addEventListener('click', function () {
                menu.classList.toggle('show');
            });
        }

        if (mobileAccountToggle && mobileAccountMenu) {
            mobileAccountToggle.addEventListener('click', function () {
                mobileAccountMenu.classList.toggle('show');
            });
        }
    });
</script>