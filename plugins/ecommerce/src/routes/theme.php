<?php 

use Mojahid\Ecommerce\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->name('ecomm.')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
});
