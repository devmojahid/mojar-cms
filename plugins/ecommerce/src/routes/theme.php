<?php

use Mojahid\Ecommerce\Http\Controllers\Frontend\CartController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CheckoutController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->name('ecomm.')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/checkout/update', [CheckoutController::class, 'update'])->name('checkout.update');

    Route::get('order/{token}/details', [
        OrderController::class, 
        'details'
    ])->name('order.details');
});
