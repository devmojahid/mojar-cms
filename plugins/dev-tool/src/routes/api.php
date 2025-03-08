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
use Juzaweb\CMS\Support\Updater\CmsUpdater;
# Route::get('/themes2', [ThemeController::class, 'getThemes']);
# Route::get('/plugins2', [PluginController::class, 'getPlugins']);

// cms/version-available
Route::get('/cms/version-available', function () {
    $updater = app(CmsUpdater::class);
    
    $currentVersion = $updater->getCurrentVersion();
    try {
        $versionAvailable = $updater->getVersionAvailable();
        // $versionAvailable = $currentVersion;
    } catch (\Exception $e) {
        report($e);
        $versionAvailable = $currentVersion;
    }
    
    return response()->json([
        'data' => [
            'version' => $versionAvailable,
            'update' => version_compare($versionAvailable, $currentVersion, '>')
        ],
        'message' => 'Get data successfully.'
    ]);
});


// themes/versions-available
Route::get('/themes/versions-available', function () {

    return response()->json([
        'data' => [
            'version' => '1.0.0',
            'update' => false
        ],
        'message' => 'Get data successfully.'
    ]);
    $updater = app(ThemeUpdater::class);
    $versionsAvailable = $updater->getVersionsAvailable();
    return response()->json(['versions' => $versionsAvailable]);
});

    
// plugins/versions-available
Route::get('/plugins/versions-available', function () {
    return response()->json([
        'data' => [
            'version' => '1.0.0',
            'update' => false
        ],
        'message' => 'Get data successfully.'
    ]);
    $updater = app(PluginUpdater::class);
    $versionsAvailable = $updater->getVersionsAvailable();
    return response()->json(['versions' => $versionsAvailable]);
});
