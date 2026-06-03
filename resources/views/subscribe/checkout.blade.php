<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Horizon</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="icon" type="image/png" href="{{ asset('storage/img/logo.png') }}">
    <style>
        *{box-sizing:border-box;}
        body{
            margin:0;
            font-family:Arial, Helvetica, sans-serif;
            background:#0b0b0b;
            color:#fff;
        }
        .checkout-page{
            min-height:100vh;
            background:linear-gradient(to bottom, rgba(0,0,0,0.35), rgba(0,0,0,0.95)), #0b0b0b;
        }
        .page-section{
            max-width:1200px;
            margin:0 auto;
            padding:40px 6% 60px;
        }
        .checkout-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:28px;
        }
        .card{
            background:linear-gradient(180deg, #151515, #101010);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            padding:28px;
            box-shadow:0 12px 34px rgba(0,0,0,0.3);
        }
        .card h2{
            margin:0 0 16px;
            font-size:28px;
        }
        .info-line{
            margin-bottom:12px;
            color:#d0d0d0;
            line-height:1.7;
        }
        .methods{
            display:grid;
            gap:14px;
            margin-top:18px;
        }
        .method{
            padding:16px;
            border-radius:16px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.08);
        }
        .method strong{
            display:block;
            margin-bottom:6px;
            color:#fff;
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
            padding:14px;
            font-size:14px;
            outline:none;
        }
        .form-control:focus{
            border-color:#e50914;
            box-shadow:0 0 0 3px rgba(229,9,20,0.12);
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
            background:#e50914;
            color:#fff;
            border:1px solid #e50914;
            cursor:pointer;
        }
        .btn-primary:hover{
            background:#b20710;
            border-color:#b20710;
        }
        .error-text{
            color:#ffb4b4;
            font-size:13px;
            margin-top:6px;
        }
        @media (max-width:900px){
            .checkout-grid{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>
<body>
    <div class="checkout-page">
        @include('layouts.navigation')

        <main class="page-section">
            <div class="checkout-grid">
                <div class="card">
                    <h2>Plan Summary</h2>

                    <div class="info-line"><strong>Plan:</strong> {{ $plan->name }}</div>
                    <div class="info-line"><strong>Price:</strong>{{ number_format($plan->price_cents / 100, 2) }}</div>
                    <div class="info-line"><strong>Duration:</strong> every {{ $plan->interval_count }} {{ \Illuminate\Support\Str::plural($plan->interval, $plan->interval_count) }}</div>
                    <div class="info-line"><strong>Description:</strong> {{ $plan->description ?: 'Premium Horizon access.' }}</div>

                    <div class="methods">
                        @foreach($paymentMethods as $method)
                            <div class="method">
                                <strong>{{ $method['name'] }}</strong>
                                Account Name: {{ $method['account_name'] }}<br>
                                Account / Number: {{ $method['account_number'] }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <h2>Payment Form</h2>

                    <form method="POST" action="{{ route('subscribe.checkout.store', $plan) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="">Select payment method</option>
                                @foreach($paymentMethods as $method)
                                    <option value="{{ $method['key'] }}" @selected(old('payment_method') === $method['key'])>
                                        {{ $method['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_method')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payer_name">Payer Name</label>
                            <input type="text" name="payer_name" id="payer_name" class="form-control" value="{{ old('payer_name') }}" required>
                            @error('payer_name')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payer_phone">Payer Phone</label>
                            <input type="text" name="payer_phone" id="payer_phone" class="form-control" value="{{ old('payer_phone') }}">
                            @error('payer_phone')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="transaction_reference">Transaction Reference</label>
                            <input type="text" name="transaction_reference" id="transaction_reference" class="form-control" value="{{ old('transaction_reference') }}" required>
                            @error('transaction_reference')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="receipt">Upload Receipt</label>
                            <input type="file" name="receipt" id="receipt" class="form-control" required>
                            @error('receipt')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" rows="4" class="form-control">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary">Submit Payment</button>
                    </form>
                </div>
            </div>
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>