<?php

use Illuminate\Support\Facades\Route;
use Juzaweb\Backend\Http\Controllers\Backend\ManagementController;

Route::get('managements', [ManagementController::class, 'index']);