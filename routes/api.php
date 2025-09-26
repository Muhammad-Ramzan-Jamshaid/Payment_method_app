<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MbmePaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/refund', [MbmePaymentController::class, 'initiateRefundPayment']);
Route::post('/create-order', [MbmePaymentController::class, 'createOrder']);
Route::post('/create-payment-link', [MbmePaymentController::class, 'createPaymentLink']);
Route::post('/payment-status', [MbmePaymentController::class, 'getStatusOfPayment']);
