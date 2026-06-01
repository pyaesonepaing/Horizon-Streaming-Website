<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Horizon</title>
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

        .contact-page{
            min-height:100vh;
            background:
                linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)),
                #0b0b0b;
        }

        .contact-hero{
            position:relative;
            padding:90px 6% 55px;
            background:
                linear-gradient(to right, rgba(0,0,0,0.9) 25%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.82) 100%),
                url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80');
            background-size:cover;
            background-position:center;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .contact-hero-content{
            max-width:760px;
        }

        .contact-tag{
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

        .contact-hero h1{
            margin:0 0 14px;
            font-size:52px;
            font-weight:900;
            line-height:1.08;
        }

        .contact-hero p{
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

        .contact-grid{
            display:grid;
            grid-template-columns: 1fr 1.1fr;
            gap:28px;
            align-items:start;
        }

        .info-card,
        .form-card{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            overflow:hidden;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
        }

        .info-card-content,
        .form-card-content{
            padding:28px;
        }

        .info-card h2,
        .form-card h2{
            margin:0 0 14px;
            font-size:28px;
            font-weight:900;
        }

        .info-card p,
        .form-card p{
            margin:0 0 18px;
            color:#cfcfcf;
            line-height:1.8;
            font-size:15px;
        }

        .info-list{
            display:flex;
            flex-direction:column;
            gap:14px;
            margin-top:22px;
        }

        .info-item{
            padding:16px 18px;
            border-radius:16px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
        }

        .info-item strong{
            display:block;
            color:#fff;
            font-size:15px;
            margin-bottom:6px;
        }

        .info-item span{
            color:#c9c9c9;
            font-size:14px;
            line-height:1.7;
        }

        .form-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:16px;
        }

        .form-group{
            display:flex;
            flex-direction:column;
            gap:8px;
        }

        .form-group.full{
            grid-column:1 / -1;
        }

        .form-group label{
            font-size:14px;
            font-weight:700;
            color:#e2e2e2;
        }

        .form-control{
            width:100%;
            background:#0e0e0e;
            border:1px solid rgba(255,255,255,0.12);
            color:#fff;
            border-radius:14px;
            padding:14px 15px;
            font-size:14px;
            outline:none;
            transition:.3s ease;
        }

        .form-control:focus{
            border-color:#e50914;
            box-shadow:0 0 0 3px rgba(229,9,20,0.12);
        }

        textarea.form-control{
            resize:vertical;
            min-height:150px;
        }

        .btn-primary{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:14px 22px;
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

        .helper-text{
            margin-top:16px;
            color:#a9a9a9;
            font-size:13px;
            line-height:1.7;
        }

        .error-text{
            color:#ffb4b4;
            font-size:13px;
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
            .contact-grid{
                grid-template-columns:1fr;
            }

            .contact-hero h1{
                font-size:40px;
            }
        }

        @media (max-width:768px){
            .contact-hero{
                padding:72px 5% 45px;
            }

            .contact-hero h1{
                font-size:32px;
            }

            .contact-hero p{
                font-size:15px;
            }

            .page-section{
                padding:28px 5% 50px;
            }

            .info-card-content,
            .form-card-content{
                padding:20px;
            }

            .form-grid{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>
<body>
    <div class="contact-page">
        @include('layouts.navigation')

        <section class="contact-hero">
            <div class="contact-hero-content">
                <span class="contact-tag">We’d Love to Hear From You</span>
                <h1>Contact Us</h1>
                <p>
                    Have a question, suggestion, or support request? Send us a message and the Horizon
                    team will get back to you as soon as possible.
                </p>
            </div>
        </section>

        <main class="page-section">
            @if(session('success'))
                <div class="success-box">
                    {{ session('success') }}
                </div>
            @endif

            <div class="contact-grid">
                <div class="info-card">
                    <div class="info-card-content">
                        <h2>Get in Touch</h2>
                        <p>
                            Whether you need help with subscriptions, video access, downloads, or general
                            information about Horizon, you can contact us anytime through this form.
                        </p>

                        <div class="info-list">
                            <div class="info-item">
                                <strong>Customer Support</strong>
                                <span>Reach out for account issues, subscription help, or download access questions.</span>
                            </div>

                            <div class="info-item">
                                <strong>Content Questions</strong>
                                <span>Ask about available videos, categories, publishing, or featured content.</span>
                            </div>

                            <div class="info-item">
                                <strong>General Feedback</strong>
                                <span>Share ideas and suggestions to improve the Horizon streaming experience.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-content">
                        <h2>Send Message</h2>
                        <p>
                            Fill out the form below and send your message directly to Horizon.
                        </p>

                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="name">Your Name</label>
                                    <input
                                        id="name"
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        placeholder="Enter your name"
                                        value="{{ old('name') }}"
                                        required
                                    >
                                    @error('name')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Enter your email"
                                        value="{{ old('email') }}"
                                        required
                                    >
                                    @error('email')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group full">
                                    <label for="subject">Subject</label>
                                    <input
                                        id="subject"
                                        type="text"
                                        name="subject"
                                        class="form-control"
                                        placeholder="Enter message subject"
                                        value="{{ old('subject') }}"
                                    >
                                    @error('subject')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group full">
                                    <label for="message">Message</label>
                                    <textarea
                                        id="message"
                                        name="message"
                                        rows="6"
                                        class="form-control"
                                        placeholder="Write your message here..."
                                        required
                                    >{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="error-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group full">
                                    <button type="submit" class="btn-primary">Send Message</button>
                                </div>
                            </div>
                        </form>

                        <div class="helper-text">
                            By sending this form, your message will be delivered to the Horizon contact system
                            for review by the admin team.
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>