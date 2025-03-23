<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Mojarsoft\DevTool\Http\Controllers\Backend\MarketplaceController;
use Mojarsoft\DevTool\Http\Controllers\Backend\UpdateController;
use Mojarsoft\DevTool\Http\Controllers\Backend\VersionController;

Route::group(['prefix' => 'dev-tool'], function () {
    // CMS Versions
    Route::get('/cms-versions', [VersionController::class, 'indexCmsVersions'])
        ->name('admin.dev-tool.cms-versions.index');
    Route::get('/cms-versions/create', [VersionController::class, 'createCmsVersion'])
        ->name('admin.dev-tool.cms-versions.create');
    Route::post('/cms-versions', [VersionController::class, 'storeCmsVersion'])
        ->name('admin.dev-tool.cms-versions.store');
    Route::get('/cms-versions/{id}/edit', [VersionController::class, 'editCmsVersion'])
        ->name('admin.dev-tool.cms-versions.edit');
    Route::put('/cms-versions/{id}', [VersionController::class, 'updateCmsVersion'])
        ->name('admin.dev-tool.cms-versions.update');
    Route::delete('/cms-versions/{id}', [VersionController::class, 'destroyCmsVersion'])
        ->name('admin.dev-tool.cms-versions.destroy');

    // Package Versions (Plugins & Themes)
    Route::get('/package-versions', [VersionController::class, 'indexPackageVersions'])
        ->name('admin.dev-tool.package-versions.index');
    Route::get('/package-versions/create', [VersionController::class, 'createPackageVersion'])
        ->name('admin.dev-tool.package-versions.create');
    Route::post('/package-versions', [VersionController::class, 'storePackageVersion'])
        ->name('admin.dev-tool.package-versions.store');
    Route::get('/package-versions/{id}/edit', [VersionController::class, 'editPackageVersion'])
        ->name('admin.dev-tool.package-versions.edit');
    Route::put('/package-versions/{id}', [VersionController::class, 'updatePackageVersion'])
        ->name('admin.dev-tool.package-versions.update');
    Route::delete('/package-versions/{id}', [VersionController::class, 'destroyPackageVersion'])
        ->name('admin.dev-tool.package-versions.destroy');

    // Marketplace Theme Routes
    Route::get('marketplace-themes', [MarketplaceController::class, 'themeIndex'])->name('admin.dev-tool.marketplace-themes.index');
    Route::get('marketplace-themes/create', [MarketplaceController::class, 'themeCreate'])->name('admin.dev-tool.marketplace-themes.create');
    Route::post('marketplace-themes', [MarketplaceController::class, 'themeStore'])->name('admin.dev-tool.marketplace-themes.store');
    Route::get('marketplace-themes/{id}/edit', [MarketplaceController::class, 'themeEdit'])->name('admin.dev-tool.marketplace-themes.edit');
    Route::put('marketplace-themes/{id}', [MarketplaceController::class, 'themeUpdate'])->name('admin.dev-tool.marketplace-themes.update');
    Route::delete('marketplace-themes/{id}', [MarketplaceController::class, 'themeDestroy'])->name('admin.dev-tool.marketplace-themes.destroy');
    Route::get('marketplace-themes/get-data', [MarketplaceController::class, 'getThemeData'])->name('admin.dev-tool.marketplace-themes.get-data');
    
    // Marketplace Plugin Routes
    Route::get('marketplace-plugins', [MarketplaceController::class, 'pluginIndex'])->name('admin.dev-tool.marketplace-plugins.index');
    Route::get('marketplace-plugins/create', [MarketplaceController::class, 'pluginCreate'])->name('admin.dev-tool.marketplace-plugins.create');
    Route::post('marketplace-plugins', [MarketplaceController::class, 'pluginStore'])->name('admin.dev-tool.marketplace-plugins.store');
    Route::get('marketplace-plugins/{id}/edit', [MarketplaceController::class, 'pluginEdit'])->name('admin.dev-tool.marketplace-plugins.edit');
    Route::put('marketplace-plugins/{id}', [MarketplaceController::class, 'pluginUpdate'])->name('admin.dev-tool.marketplace-plugins.update');
    Route::delete('marketplace-plugins/{id}', [MarketplaceController::class, 'pluginDestroy'])->name('admin.dev-tool.marketplace-plugins.destroy');
    Route::get('marketplace-plugins/get-data', [MarketplaceController::class, 'getPluginData'])->name('admin.dev-tool.marketplace-plugins.get-data');
    
    // Marketplace Dashboard
    Route::get('marketplace', [MarketplaceController::class, 'index'])->name('admin.dev-tool.marketplace');
});
