<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

use Mojar\Api\Http\Controllers\UserController;

Route::group(
    [
        'prefix' => 'profile',
        'middleware' => 'auth:api',
    ],
    function () {
        Route::get('/', [UserController::class, 'profile']);
    }
);
