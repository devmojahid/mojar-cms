<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\CMS\Support\Route;

use Illuminate\Support\Facades\Route;
use Mojar\Backend\Http\Controllers\Auth\LoginController;
use Mojar\Backend\Http\Controllers\Auth\RegisterController;
use Mojar\Backend\Http\Controllers\Auth\ForgotPasswordController;
use Mojar\Backend\Http\Controllers\Auth\ResetPasswordController;
use Mojar\Backend\Http\Controllers\Auth\SocialLoginController;

class Auth
{
    public static function routes(): void
    {
        Route::group(
            [
                'middleware' => 'guest',
            ],
            function () {
                Route::get('login', [LoginController::class, 'index'])->name('login');
                Route::post('login', [LoginController::class, 'login']);

                Route::get('register', [RegisterController::class, 'index'])->name('register');
                Route::post('register', [RegisterController::class, 'register']);

                Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot_password');
                Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);

                Route::get(
                    'reset-password/{email}/{token}',
                    [ResetPasswordController::class, 'index']
                )->name('reset_password');
                Route::post('reset-password/{email}/{token}', [ResetPasswordController::class, 'resetPassword']);

                Route::get(
                    'verification/{email}/{token}',
                    [RegisterController::class, 'verification']
                )->name('verification');

                Route::get(
                    'auth/{method}/redirect',
                    [SocialLoginController::class, 'redirect']
                )->name('auth.socialites.redirect');

                Route::get(
                    'auth/{method}/callback',
                    [SocialLoginController::class, 'callback']
                )->name('auth.socialites.callback');
            }
        );

        Route::group(
            ['middleware' => 'auth'],
            function () {
                Route::post(
                    'logout',
                    [LoginController::class, 'logout']
                )
                    ->name('logout');
            }
        );
    }
}
