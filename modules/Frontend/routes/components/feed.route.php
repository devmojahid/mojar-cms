<?php

use Mojar\Frontend\Http\Controllers\FeedController;

Route::get('feed', [FeedController::class, 'index'])->name('feed');
Route::get('taxonomy/{taxonomy}/feed', [FeedController::class, 'taxonomy'])->name('feed.taxonomy');
