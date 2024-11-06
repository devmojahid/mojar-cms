<?php

use Mojar\API\Http\Controllers\Admin\Media\FileController;
use Mojar\API\Http\Controllers\Admin\Media\FolderController;

Route::get('media/folders', [FolderController::class, 'index']);
Route::get('media/files', [FileController::class, 'index']);
