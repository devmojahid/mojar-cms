<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

use Juzaweb\API\Http\Controllers\Admin\UserController;

Route::group(
    [],
    function () {
        Route::apiResource('users', UserController::class)->names('admin.user');
    }
);
