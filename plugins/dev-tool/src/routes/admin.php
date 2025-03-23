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
});
