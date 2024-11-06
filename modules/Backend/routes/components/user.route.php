<?php

/**
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://github.com/mojar/cms
 * @license    GNU V2
 */

use Mojar\Backend\Http\Controllers\Backend\Profile\ProfileController;
use Mojar\Backend\Http\Controllers\Backend\RoleController;
use Mojar\Backend\Http\Controllers\Backend\UserController;

Route::jwResource('users', UserController::class);

Route::jwResource('roles', RoleController::class);

Route::group(
    ['prefix' => 'profile'],
    function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile');
        Route::put('/', [ProfileController::class, 'update']);
        Route::post('change-password', [ProfileController::class, 'changePassword'])
            ->name('admin.profile.change-password');
        Route::get('notification-datatable', [ProfileController::class, 'notificationDatatable']);

        Route::get('notification/{id}', [ProfileController::class, 'notification'])->name('admin.profile.notification');
    }
);
