<?php

use Mojahid\EventManagement\Http\Controllers\Frontend\BookingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function() {
    Route::get('event-booking/completed', [
        BookingController::class, 
        'completed'
    ])->name('event.booking.completed');
    
    Route::get('event-booking/cancelled', [
        BookingController::class, 
        'cancelled'
    ])->name('event.booking.cancelled');
}); 