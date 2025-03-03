<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Support\Facades\Route;
use Mojahid\EventManagement\Http\Controllers\Frontend\EventBookingController;

Route::prefix('event-management')->group(function () {
    Route::get('bookings/{code}', [EventBookingController::class, 'getBooking'])
        ->name('api.event.booking.get');
});


