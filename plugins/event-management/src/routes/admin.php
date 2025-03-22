<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

use Mojahid\EventManagement\Http\Controllers\EventBookingController;
// use Mojahid\EventManagement\Http\Controllers\Backend\TicketController;
use Mojahid\EventManagement\Http\Controllers\SettingController;


use Illuminate\Support\Facades\Route;


Route::jwResource(
    'event-management/event-bookings',
    EventBookingController::class,
    [
        'name' => 'event-bookings'
    ]
);

Route::get('event-management/settings', [SettingController::class, 'index'])->name('admin.event-management.setting');
