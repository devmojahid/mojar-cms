<?php

use Mojahid\EventManagement\Http\Controllers\Frontend\BookingController;
use Mojahid\EventManagement\Http\Controllers\Frontend\EventBookingController;
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
    
    Route::get('event-booking/{code}/details', [
        BookingController::class, 
        'details'
    ])->name('event.booking.details');
    
    Route::get('event-booking/{code}/payment', [
        BookingController::class, 
        'payment'
    ])->name('event.payment');
    
    Route::post('event-booking/process-payment', [
        BookingController::class, 
        'processPayment'
    ])->name('event.booking.process_payment');
    
    Route::get('event-booking/{code}', [
        EventBookingController::class, 
        'getBooking'
    ])->name('event.booking.get');
}); 