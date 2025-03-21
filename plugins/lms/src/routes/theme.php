<?php

use Illuminate\Support\Facades\Route;
use Mojahid\Lms\Http\Controllers\Frontend\CourseController;

Route::middleware('web')->name('lms.')->group(function () {
    // Course review routes
    Route::post('courses/{slug}/review', [CourseController::class, 'storeReview'])
        ->middleware('auth')
        ->name('courses.review');
});
