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

use Mojahid\Ecommerce\Http\Controllers\Backend\{
    OrderController,
    CustomerController,
    InvoiceController,
    SettingController
};

use Illuminate\Support\Facades\Route;

Route::jwResource(
    'ecommerce/orders',
    OrderController::class,
    [
        'name' => 'orders'
    ]
);

Route::jwResource(
    'ecommerce/customers',
    CustomerController::class,
    [
        'name' => 'customers'
    ]
);

Route::get('ecommerce/settings', [SettingController::class, 'index'])->name('admin.ecommerce.setting');

