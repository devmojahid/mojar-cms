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
use Mojarsoft\DevTool\Http\Controllers\CmsController;

// CMS Update Routes
Route::prefix('cms')->group(function () {
    Route::get('/version-available', [CmsController::class, 'getVersionAvailable']);
    Route::get('/update', [CmsController::class, 'getUpdate']);
    Route::get('/download', [CmsController::class, 'download'])->name('api.cms.download');
});

// Theme Update Routes
Route::prefix('themes')->group(function () {
    Route::post('/versions-available', [ThemeController::class, 'getVersionsAvailable']);
    Route::get('/{theme}/version-available', [ThemeController::class, 'getVersionAvailable']);
    Route::get('/{theme}/update', [ThemeController::class, 'getUpdate']);
    Route::get('/{theme}/download', [ThemeController::class, 'download'])->name('api.themes.download');
    if (config('mojar.api.external-service')) {
        Route::get('/', [ThemeController::class, 'getThemes']);
    }
});

// Plugin Update Routes
Route::prefix('plugins')->group(function () {
    Route::post('/versions-available', [PluginController::class, 'getVersionsAvailable']);
    Route::get('/{vendor}/{plugin}/version-available', [PluginController::class, 'getVersionAvailable'])
        ->where(['vendor' => '[a-z0-9-]+', 'plugin' => '[a-z0-9-]+']);
    Route::get('/{vendor}/{plugin}/update', [PluginController::class, 'getUpdate'])
        ->where(['vendor' => '[a-z0-9-]+', 'plugin' => '[a-z0-9-]+']);
    Route::get('/{vendor}/{plugin}/download', [PluginController::class, 'download'])
        ->name('api.plugins.download')
        ->where(['vendor' => '[a-z0-9-]+', 'plugin' => '[a-z0-9-]+']);
    if (config('mojar.api.external-service')) {
        Route::get('/', [PluginController::class, 'getPlugins']);
    }
});
