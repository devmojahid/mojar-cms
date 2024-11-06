<?php

Route::group(
    ['prefix' => 'menus'],
    function () {
        Route::get('{location}', [\Mojar\API\Http\Controllers\MenuController::class, 'show']);
    }
);
