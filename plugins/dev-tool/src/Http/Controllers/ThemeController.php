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
        
        if (!is_array($themes)) {
            return response()->json([
                'data' => $result
            ]);
        }
        
        foreach ($themes as $theme) {
            // Ensure theme data is valid
            if (!is_array($theme) || !isset($theme['name'])) {
                continue;
            }
            
            $name = $theme['name'];
            $currentVersion = $theme['current_version'] ?? '1.0.0';
            
            try {
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
                    'download_url' => $latestVersion->download_url ?: route('api.api.themes.download', ['theme' => $name]),
                ];
            } catch (\Exception $e) {
                // Log the error but continue processing other themes
                \Log::error("Error processing theme version for '{$name}': " . $e->getMessage());
                
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
        $installMode = $currentVersion === '0'; // If current version is 0, we're installing, not updating
        
        try {
            // Log what we're trying to do
            \Log::info("Theme update request:", [
                'theme' => $theme,
                'current_version' => $currentVersion,
                'mode' => $installMode ? 'install' : 'update'
            ]);
            
            // Get latest version from the database
            $latestVersion = PackageVersion::getLatest($theme, 'theme');
            
            // If we're in install mode (current version is 0), we should provide the latest version
            // even if it's not newer than the current version
            if (!$latestVersion) {
                return response()->json([
                    'status' => false,
                    'data' => ['message' => $installMode ? 'Theme not found' : 'No update available']
                ]);
            }
            
            // Only check if newer when not in install mode
            if (!$installMode && !$latestVersion->isNewer($currentVersion)) {
                return response()->json([
                    'status' => false,
                    'data' => ['message' => 'No update available']
                ]);
            }
            
            $downloadUrl = $latestVersion->download_url ?: route('api.api.themes.download', [
                'theme' => $theme,
                'version' => $latestVersion->version
            ]);
            
            // Log the download URL for debugging
            \Log::info("Theme update response for {$theme}:", [
                'download_url' => $downloadUrl,
                'version' => $latestVersion->version
            ]);
            
            // Create the proper response structure expected by UpdateManager
            $response = [
                'status' => true,
                'data' => [
                    'version' => $latestVersion->version,
                    'link' => $downloadUrl,
                    'changelog' => $latestVersion->changelog ?? '',
                ]
            ];
            
            // Log the full response for debugging
            \Log::info("Full theme update response:", ['response' => $response]);
            
            return response()->json($response);
        } catch (\Exception $e) {
            \Log::error("Theme update check failed: {$e->getMessage()}", [
                'exception' => $e
            ]);
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Update check failed: ' . $e->getMessage()]
            ]);
        }
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
        
        // Log download request for debugging
        \Log::info("Theme download request:", [
            'theme' => $theme,
            'version' => $version
        ]);
        
        try {
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
            
            if (!$versionModel) {
                \Log::error("Download failed: No version found for theme {$theme}");
                return response()->json([
                    'error' => true,
                    'message' => 'Theme version not found',
                ], 404);
            }
            
            if (!$versionModel->file_path) {
                \Log::error("Download failed: No file path for theme {$theme}, version {$versionModel->version}");
                return response()->json([
                    'error' => true,
                    'message' => 'Theme package file path not defined',
                ], 404);
            }
            
            $filePath = $versionModel->getFullPath();
            
            if (!file_exists($filePath)) {
                \Log::error("Download failed: File does not exist at {$filePath}");
                
                // Additional logging to help debug file location issues
                \Log::info("File path details:", [
                    'file_path' => $versionModel->file_path,
                    'storage_path' => Storage::path(''),
                    'full_path' => $filePath,
                    'storage_exists' => Storage::exists($versionModel->file_path)
                ]);
                
                return response()->json([
                    'error' => true,
                    'message' => 'Theme package file not found',
                ], 404);
            }
            
            \Log::info("Serving theme download:", [
                'theme' => $theme,
                'version' => $versionModel->version,
                'file' => $filePath
            ]);
            
            // Create a clean filename for the download
            $downloadFilename = $theme . '-' . $versionModel->version . '.zip';
            
            return response()->download($filePath, $downloadFilename);
        } catch (\Exception $e) {
            \Log::error("Error downloading theme '{$theme}': " . $e->getMessage(), [
                'exception' => $e
            ]);
            return response()->json([
                'error' => true,
                'message' => 'Error downloading theme: ' . $e->getMessage(),
            ], 500);
        }
    }
}
