<?php

use Mojahid\Ecommerce\Http\Controllers\Frontend\CartController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->name('ecomm.')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::match(['post', 'patch'], '/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/update', [CheckoutController::class, 'update'])->name('checkout.update');
});
