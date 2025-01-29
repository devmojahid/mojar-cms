<?php
    
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Support\Facades\Route;
use Mojarsoft\DevTool\Http\Controllers\ThemeController;
use Mojarsoft\DevTool\Http\Controllers\PluginController;

Route::get('/themes2', [ThemeController::class, 'getThemes']);
Route::get('/plugins2', [PluginController::class, 'getPlugins']);


    
