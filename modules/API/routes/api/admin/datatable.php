<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

use Mojar\API\Http\Controllers\Admin\DataTableController;

Route::group(
    [
        'prefix' => 'datatable',
    ],
    function () {
        Route::get('/{id}', [DataTableController::class, 'show']);
        //Route::get('/{id}/data', [DataTableController::class, 'getData']);
    }
);
