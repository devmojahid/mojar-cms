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

use Mojahid\Lms\Http\Controllers\Backend\{
    CustomerController,
    InvoiceController,
    SettingController,
};

use Illuminate\Support\Facades\Route;

Route::jwResource(
    'lms/orders',
    OrderController::class,
    [
        'name' => 'orders'
    ]
);

Route::jwResource(
    'lms/customers',
    CustomerController::class,
    [
        'name' => 'customers'
    ]
);

Route::get('lms/settings', [SettingController::class, 'index'])->name('admin.lms.setting');