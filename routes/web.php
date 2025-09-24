<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MbmePaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Page load karne ke liye
Route::get('/payment', function () {
    return view('payment'); // resources/views/payment.blade.php
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::post('/payment/createOrder', [MbmePaymentController::class, 'createOrder'])->name('payment.createOrder');
Route::post('/payment/createLink', [MbmePaymentController::class, 'createLink'])->name('payment.createLink');
Route::post('/payment/status', [MbmePaymentController::class, 'checkStatus'])->name('payment.status');
Route::post('/payment/refund', [MbmePaymentController::class, 'refund'])->name('payment.refund');

    
});

require __DIR__.'/auth.php';
