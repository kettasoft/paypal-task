<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;


Route::controller(PayController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', 'home')->name('home');
        Route::post('payment', 'payment')->name('payment');
        Route::get('pay_success', 'successPayment')->name('success');
        Route::get('fail', 'failPayment')->name('fail');
        Route::get('transactions', 'allTransactions')->name('transactions.all');
    });
});

Auth::routes();
