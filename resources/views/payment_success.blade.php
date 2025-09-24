@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <style>
        .success-box {
            max-width: 600px;
            margin: auto;
            text-align: center;
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
        }
    </style>

    <div class="card success-box shadow-lg p-5 rounded-4">
        <div class="success-icon mb-3">
            ✅
        </div>
        <h2 class="fw-bold text-success mb-3">Payment Successful!</h2>
        <p class="text-muted mb-4">Thank you for your payment. Your transaction was completed successfully.</p>

        <a href="/" class="btn btn-primary rounded-pill px-4 py-2">Go to Home</a>
    </div>
</div>
@endsection
