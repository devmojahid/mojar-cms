<?php

use Illuminate\Support\Facades\Route;
use Mojahid\EdufaxHelper\Http\Controllers\PostFilterController;

Route::group(['middleware' => ['web']], function() {
    // AJAX route for post filtering
    Route::post('ajax/posts/filter', [PostFilterController::class, 'filter'])
        ->name('theme.posts.filter');
}); 