@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <style>
        .iframe-box {
            max-width: 900px;
            margin: auto;
            text-align: center;
        }
        .iframe-box iframe {
            width: 100%;
            height: 600px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>

    <div class="card iframe-box shadow-lg p-4 rounded-4">
        <h2 class="fw-bold mb-4">Payment Iframe</h2>

        <!-- Example Iframe (Replace src with dynamic URL from backend) -->
        <iframe src="https://example.com/payment-page" allowpaymentrequest="true"></iframe>
    </div>
</div>
@endsection
