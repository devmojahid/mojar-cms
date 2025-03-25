<?php

namespace Mojarsoft\DevTool\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Facades\Plugin;
use Juzaweb\CMS\Version;
use Mojarsoft\DevTool\Models\PackageVersion;
use Mojarsoft\DevTool\Models\MarketplacePlugin;
use Mojarsoft\DevTool\Models\CmsVersion;
use Juzaweb\Backend\Http\Resources\PluginResource;

class PluginController extends BackendController
{       
    public function getPlugins(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        
        $plugins = MarketplacePlugin::active()
            ->orderBy('is_featured', 'DESC')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
        
        return PluginResource::collection($plugins);
    }
    
    /**
     * Get available versions for plugins
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getVersionsAvailable(Request $request): JsonResponse
    {
        $plugins = $request->input('plugins', []);
        $cmsVersion = $request->input('cms_version', Version::getVersion());
        
        $result = [];
        
        if (!is_array($plugins)) {
            return response()->json([
                'data' => $result
            ]);
        }
        
        foreach ($plugins as $plugin) {
            // Ensure plugin data is valid
            if (!is_array($plugin) || !isset($plugin['name'])) {
                continue;
            }
            
            $name = $plugin['name'];
            $currentVersion = $plugin['current_version'] ?? '1.0.0';
            
            try {
                // Get latest version from the database
                $latestVersion = PackageVersion::getLatest($name, 'plugin');
                
                if (!$latestVersion) {
                    $result[$name] = [
                        'version' => $currentVersion,
                        'update' => false,
                    ];
                    continue;
                }
                
                $result[$name] = [
                    'version' => $latestVersion->version,
                    'update' => $latestVersion->isNewer($currentVersion),
                    'download_url' => $latestVersion->download_url ?: route('api.plugins.download', ['plugin' => $name]),
                ];
            } catch (\Exception $e) {
                // Log the error but continue processing other plugins
                \Log::error("Error processing plugin version for '{$name}': " . $e->getMessage());
                
                $result[$name] = [
                    'version' => $currentVersion,
                    'update' => false,
                    'error' => 'Could not check for updates'
                ];
            }
        }
        
        return response()->json([
            'data' => $result
        ]);
    }
    
    /**
     * Get version available for a specific plugin
     * 
     * @param Request $request
     * @param string $vendor
     * @param string $plugin
     * @return JsonResponse
     */
    public function getVersionAvailable(Request $request, string $vendor, string $plugin): JsonResponse
    {
        $currentVersion = $request->input('current_version', '1.0.0');
        $cmsVersion = $request->input('cms_version', Version::getVersion());
        
        // Get latest version from the database
        $latestVersion = PackageVersion::getLatest("{$vendor}/{$plugin}", 'plugin');
        
        if (!$latestVersion) {
            return response()->json([
                'data' => [
                    'version' => $currentVersion,
                    'update' => false,
                ]
            ]);
        }
        
        return response()->json([
            'data' => [
                'version' => $latestVersion->version,
                'update' => $latestVersion->isNewer($currentVersion),
            ]
        ]);
    }
    
    /**
     * Get update package for a plugin
     * 
     * @param Request $request
     * @param string $vendor
     * @param string $plugin
     * @return JsonResponse
     */
    public function getUpdate(Request $request, string $vendor, string $plugin): JsonResponse
    {
        $pluginName = "{$vendor}/{$plugin}";
        $currentVersion = $request->input('current_version', '1.0.0');
        $installMode = $currentVersion === '0'; // If current version is 0, we're installing, not updating
    
        try {
            $latestVersion = PackageVersion::getLatest($pluginName, 'plugin');
            
            // Log what we're trying to do
            \Log::info("Plugin update request:", [
                'plugin' => $pluginName,
                'current_version' => $currentVersion,
                'mode' => $installMode ? 'install' : 'update',
                'latest_version_found' => $latestVersion ? $latestVersion->version : 'none'
            ]);
            
            // If we're in install mode (current version is 0), we should provide the latest version
            // even if it's not newer than the current version
            if (!$latestVersion) {
                return response()->json([
                    'status' => false,
                    'data' => ['message' => $installMode ? 'Plugin not found' : 'No update available']
                ]);
            }
            
            // Only check if newer when not in install mode
            if (!$installMode && !$latestVersion->isNewer($currentVersion)) {
                return response()->json([
                    'status' => false,
                    'data' => ['message' => 'No update available']
                ]);
            }
            
            $downloadUrl = $latestVersion->download_url ?: route('api.plugins.download', [
                'vendor' => $vendor, 
                'plugin' => $plugin
            ]);
    
            // Log the download URL for debugging
            \Log::info("Plugin update response for {$pluginName}:", [
                'download_url' => $downloadUrl,
                'version' => $latestVersion->version
            ]);
            
            // We need to ensure this structure is exactly what the UpdateManager expects
            // Specifically response->data->link should be available
            $response = [
                'status' => true,
                'data' => [
                    'version' => $latestVersion->version,
                    'link' => $downloadUrl,  // This is critical for UpdateManager->downloadUpdateFile()
                    'checksum' => $latestVersion->checksum ?? '',
                    'changelog' => $latestVersion->changelog ?? '',
                    
                    // Also include fields that might be used by our adapter
                    'download_url' => $downloadUrl, // Alternative field name
                    'url' => $downloadUrl // Another possible field name
                ]
            ];
            
            // Log the full response for debugging
            \Log::info("Full plugin update response:", ['response' => $response]);
            
            return response()->json($response);
        } catch (\Exception $e) {
            \Log::error("Update check failed: {$e->getMessage()}", [
                'exception' => $e
            ]);
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Update check failed: ' . $e->getMessage()]
            ]);
        }
    }
    
    public function getUpdateold(Request $request, string $vendor, string $plugin): JsonResponse
    {
        $pluginName = "{$vendor}/{$plugin}";
        $currentVersion = $request->input('current_version', '1.0.0');
        $cmsVersion = $request->input('cms_version', Version::getVersion());
        return response()->json([
            'status' => true,
            'data' => [
                'version' => $currentVersion,
                'cms_version' => $cmsVersion,
                'plugin_name' => $pluginName
            ]
        ]);
        try {
            // Get latest version from the database
            $latestVersion = PackageVersion::getLatest($pluginName, 'plugin');
            
            if (!$latestVersion || !$latestVersion->isNewer($currentVersion)) {
                return response()->json([
                    'status' => false,
                    'data' => [
                        'message' => 'No update available'
                    ]
                ]);
            }
            
            $downloadUrl = $latestVersion->download_url;
            
            // If no external download URL is set, use our local endpoint
            if (empty($downloadUrl)) {
                $downloadUrl = route('api.plugins.download', ['vendor' => $vendor, 'plugin' => $plugin]);
            }
            
            // Return nested data structure expected by PluginUpdater
            return response()->json([
                'status' => true,
                'data' => [
                    'data' => [
                        'version' => $latestVersion->version,
                        'link' => $downloadUrl
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error("Error getting plugin update for '{$pluginName}': " . $e->getMessage());
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'Error checking for updates: ' . $e->getMessage()
                ]
            ]);
        }
    }
    
    /**
     * Download a plugin package
     * 
     * @param Request $request
     * @param string $vendor
     * @param string $plugin
     * @return JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, string $vendor, string $plugin)
    {
        $pluginName = "{$vendor}/{$plugin}";
        $version = $request->input('version');
        
        // Log download request for debugging
        \Log::info("Plugin download request:", [
            'plugin' => $pluginName,
            'version' => $version
        ]);
        
        try {
            // If version is specified, get that version, otherwise get latest
            if ($version) {
                $versionModel = PackageVersion::where('package_name', $pluginName)
                    ->where('package_type', 'plugin')
                    ->where('version', $version)
                    ->where('is_active', true)
                    ->first();
            } else {
                $versionModel = PackageVersion::getLatest($pluginName, 'plugin');
            }
            
            if (!$versionModel) {
                \Log::error("Download failed: No version found for plugin {$pluginName}");
                return response()->json([
                    'error' => true,
                    'message' => 'Plugin version not found',
                ], 404);
            }
            
            if (!$versionModel->file_path) {
                \Log::error("Download failed: No file path for plugin {$pluginName}, version {$versionModel->version}");
                return response()->json([
                    'error' => true,
                    'message' => 'Plugin package file path not defined',
                ], 404);
            }
            
            $filePath = $versionModel->getFullPath();
            
            if (!file_exists($filePath)) {
                \Log::error("Download failed: File does not exist at {$filePath}");
                return response()->json([
                    'error' => true,
                    'message' => 'Plugin package file not found',
                ], 404);
            }
            
            \Log::info("Serving plugin download:", [
                'plugin' => $pluginName,
                'version' => $versionModel->version,
                'file' => $filePath
            ]);
            
            return response()->download($filePath);
        } catch (\Exception $e) {
            \Log::error("Error downloading plugin '{$pluginName}': " . $e->getMessage(), [
                'exception' => $e
            ]);
            return response()->json([
                'error' => true,
                'message' => 'Error downloading plugin: ' . $e->getMessage(),
            ], 500);
        }
    }
}
