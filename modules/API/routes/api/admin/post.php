<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

use Juzaweb\API\Http\Controllers\Admin\PostController;

Route::group(
    [
        'prefix' => 'post-type',
    ],
    function () {
        Route::apiResource(
            '{type}',
            PostController::class,
            [
                'parameters' => [
                    '{type}' => 'id',
                ],
                'names' => 'post_type',
            ]
        );
    }
);
