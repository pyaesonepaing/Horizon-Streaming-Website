<footer class="hz-footer">
    <div class="hz-footer-container">
        <p class="hz-footer-top">Questions? Contact us anytime.</p>

        <div class="hz-footer-grid">
            <a href="#">FAQ</a>
            <a href="#">Help Center</a>
            <a href="#">Account</a>
            <a href="#">Media Center</a>
            <a href="#">Investor Relations</a>
            <a href="#">Jobs</a>
            <a href="#">Ways to Watch</a>
            <a href="#">Terms of Use</a>
            <a href="#">Privacy</a>
            <a href="#">Cookie Preferences</a>
            <a href="#">Corporate Information</a>
            <a href="{{ route('contacts.index') }}">Contact Us</a>
        </div>

        <div class="hz-footer-brand">Horizon</div>
        <p class="hz-footer-copy">© {{ date('Y') }} Horizon. All rights reserved.</p>
    </div>
</footer>

<style>
    .hz-footer {
        background: #000;
        color: #757575;
        padding: 60px 20px 35px;
        margin-top: 60px;
        border-top: 1px solid rgba(255,255,255,0.06);
    }

    .hz-footer-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .hz-footer-top {
        font-size: 16px;
        margin-bottom: 28px;
        color: #b3b3b3;
    }

    .hz-footer-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(150px, 1fr));
        gap: 16px 24px;
        margin-bottom: 35px;
    }

    .hz-footer-grid a {
        color: #757575;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .hz-footer-grid a:hover {
        color: #fff;
        text-decoration: underline;
    }

    .hz-footer-brand {
        color: #e50914;
        font-size: 24px;
        font-weight: 900;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .hz-footer-copy {
        font-size: 13px;
        color: #8c8c8c;
    }

    @media (max-width: 768px) {
        .hz-footer-grid {
            grid-template-columns: repeat(2, minmax(140px, 1fr));
        }
    }

    @media (max-width: 480px) {
        .hz-footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>