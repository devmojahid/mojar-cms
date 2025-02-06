<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://github.com/mojar/cms
 * @license    GNU V2
 */

use Juzaweb\Backend\Http\Controllers\Backend\PaymentMethodController;
use Illuminate\Support\Facades\Route;

Route::jwResource('payment-methods', PaymentMethodController::class,[ 'name' => 'payment_methods']);

