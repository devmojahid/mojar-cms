<?php

use Illuminate\Support\Facades\Route;
use Mojahid\EdufaxHelper\Http\Controllers\PostFilterController;
use Mojahid\EdufaxHelper\Http\Controllers\CourseFilterController;

Route::group(['middleware' => ['web']], function() {
    // AJAX route for post filtering
    Route::post('ajax/posts/filter', [PostFilterController::class, 'filter'])
        ->name('theme.posts.filter');

    // AJAX route for course filtering
    Route::post('ajax/courses/filter', [CourseFilterController::class, 'filter']);
}); 