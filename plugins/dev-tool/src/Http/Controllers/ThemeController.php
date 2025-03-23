<?php

namespace Mojarsoft\DevTool\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Facades\ThemeLoader;
use Juzaweb\CMS\Version;
use Mojarsoft\DevTool\Models\PackageVersion;
use Mojarsoft\DevTool\Models\MarketplaceTheme;
use Mojarsoft\DevTool\Models\CmsVersion;
use Juzaweb\Backend\Http\Resources\ThemeResource;

class ThemeController extends BackendController
{       
    public function getThemes(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        
        $themes = MarketplaceTheme::active()
            ->orderBy('is_featured', 'DESC')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
        
        return ThemeResource::collection($themes);
    }

    /**
     * Get available versions for themes
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getVersionsAvailable(Request $request): JsonResponse
    {
        $themes = $request->input('themes', []);
        $cmsVersion = $request->input('cms_version', Version::getVersion());
        
        $result = [];
        
        foreach ($themes as $theme) {
            $name = $theme['name'] ?? '';
            $currentVersion = $theme['current_version'] ?? '1.0.0';
            
            // Get latest version from the database
            $latestVersion = PackageVersion::getLatest($name, 'theme');
            
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
                'download_url' => $latestVersion->download_url ?: route('api.themes.download', ['theme' => $name]),
            ];
        }
        
        return response()->json([
            'data' => $result
        ]);
    }
    
    /**
     * Get version available for a specific theme
     * 
     * @param Request $request
     * @param string $theme
     * @return JsonResponse
     */
    public function getVersionAvailable(Request $request, string $theme): JsonResponse
    {
        $currentVersion = $request->input('current_version', '1.0.0');
        $cmsVersion = $request->input('cms_version', Version::getVersion());
        
        // Get latest version from the database
        $latestVersion = PackageVersion::getLatest($theme, 'theme');
        
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
     * Get update package for a theme
     * 
     * @param Request $request
     * @param string $theme
     * @return JsonResponse
     */
    public function getUpdate(Request $request, string $theme): JsonResponse
    {
        $currentVersion = $request->input('current_version', '1.0.0');
        $cmsVersion = $request->input('cms_version', Version::getVersion());
        
        // Get latest version from the database
        $latestVersion = PackageVersion::getLatest($theme, 'theme');
        
        if (!$latestVersion || !$latestVersion->isNewer($currentVersion)) {
            return response()->json([
                'error' => true,
                'message' => 'No update available',
            ], 404);
        }
        
        $downloadUrl = $latestVersion->download_url;
        
        // If no external download URL is set, use our local endpoint
        if (empty($downloadUrl)) {
            $downloadUrl = route('api.themes.download', ['theme' => $theme]);
        }
        
        return response()->json([
            'data' => [
                'version' => $latestVersion->version,
                'link' => $downloadUrl,
            ]
        ]);
    }
    
    /**
     * Download a theme package
     * 
     * @param Request $request
     * @param string $theme
     * @return JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, string $theme)
    {
        $version = $request->input('version');
        
        // If version is specified, get that version, otherwise get latest
        if ($version) {
            $versionModel = PackageVersion::where('package_name', $theme)
                ->where('package_type', 'theme')
                ->where('version', $version)
                ->where('is_active', true)
                ->first();
        } else {
            $versionModel = PackageVersion::getLatest($theme, 'theme');
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
