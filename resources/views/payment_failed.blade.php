@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <style>
        .failed-box {
            max-width: 600px;
            margin: auto;
            text-align: center;
        }
        .failed-icon {
            font-size: 80px;
            color: #dc3545;
        }
    </style>

    <div class="card failed-box shadow-lg p-5 rounded-4">
        <div class="failed-icon mb-3">
            ❌
        </div>
        <h2 class="fw-bold text-danger mb-3">Payment Failed!</h2>
        <p class="text-muted mb-4">Unfortunately, your transaction could not be processed. Please try again later.</p>

        <a href="/" class="btn btn-primary rounded-pill px-4 py-2">Go to Home</a>
    </div>
</div>
@endsection
        