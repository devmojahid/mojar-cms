<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

use Juzaweb\API\Http\Controllers\Admin\SettingController;

Route::group(
    [
        'prefix' => 'setting',
    ],
    function () {
        Route::get('configs', [SettingController::class, 'configs']);
    }
);
