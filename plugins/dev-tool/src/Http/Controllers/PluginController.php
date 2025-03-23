<?php

namespace Mojarsoft\DevTool\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Version;
use Mojarsoft\DevTool\Models\PackageVersion;

class PluginController extends BackendController
{       
    public function getPlugins()
    {
        return response()->json([
            'status' => true,
            'data' => [
                'plugins' => [],
            ],
        ]);

        // return response()->json(Theme::all());
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
        
        foreach ($plugins as $plugin) {
            $name = $plugin['name'] ?? '';
            $currentVersion = $plugin['current_version'] ?? '1.0.0';
            
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
        }
        
        return response()->json([
            'data' => $result
        ]);
    }
    
    /**
     * Get version available for a specific plugin
     * 
     * @param Request $request
     * @param string $plugin
     * @return JsonResponse
     */
    public function getVersionAvailable(Request $request, string $plugin): JsonResponse
    {
        $currentVersion = $request->input('current_version', '1.0.0');
        $cmsVersion = $request->input('cms_version', Version::getVersion());
        
        // Get latest version from the database
        $latestVersion = PackageVersion::getLatest($plugin, 'plugin');
        
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
     * @param string $plugin
     * @return JsonResponse
     */
    public function getUpdate(Request $request, string $plugin): JsonResponse
    {
        $currentVersion = $request->input('current_version', '1.0.0');
        $cmsVersion = $request->input('cms_version', Version::getVersion());
        
        // Get latest version from the database
        $latestVersion = PackageVersion::getLatest($plugin, 'plugin');
        
        if (!$latestVersion || !$latestVersion->isNewer($currentVersion)) {
            return response()->json([
                'error' => true,
                'message' => 'No update available',
            ], 404);
        }
        
        $downloadUrl = $latestVersion->download_url;
        
        // If no external download URL is set, use our local endpoint
        if (empty($downloadUrl)) {
            $downloadUrl = route('api.plugins.download', ['plugin' => $plugin]);
        }
        
        return response()->json([
            'data' => [
                'version' => $latestVersion->version,
                'link' => $downloadUrl,
            ]
        ]);
    }
    
    /**
     * Download a plugin package
     * 
     * @param Request $request
     * @param string $plugin
     * @return JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, string $plugin)
    {
        $version = $request->input('version');
        
        // If version is specified, get that version, otherwise get latest
        if ($version) {
            $versionModel = PackageVersion::where('package_name', $plugin)
                ->where('package_type', 'plugin')
                ->where('version', $version)
                ->where('is_active', true)
                ->first();
        } else {
            $versionModel = PackageVersion::getLatest($plugin, 'plugin');
        }
        
        if (!$versionModel || !$versionModel->file_path) {
            return response()->json([
                'error' => true,
                'message' => 'Update package not found',
            ], 404);
        }
        
        $filePath = $versionModel->getFullPath();
        
        if (!file_exists($filePath)) {
            return response()->json([
                'error' => true,
                'message' => 'Update package file not found',
            ], 404);
        }
        
        return response()->download($filePath);
    }
}
