<?php

namespace Mojarsoft\DevTool\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Version;
use Mojarsoft\DevTool\Models\CmsVersion;
use Illuminate\Support\Facades\Storage;

class CmsController extends BackendController
{
    /**
     * Get available version for the CMS
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getVersionAvailable(Request $request): JsonResponse
    {
        $currentVersion = $request->input('current_version', Version::getVersion());
        
        // Get latest version from the database
        $latestVersion = CmsVersion::getLatest();
        
        if (!$latestVersion) {
            // No version available, return current version
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
     * Get update package for the CMS
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getUpdate(Request $request): JsonResponse
    {
        $currentVersion = $request->input('current_version', Version::getVersion());
        
        // Get latest version from the database
        $latestVersion = CmsVersion::getLatest();
        
        if (!$latestVersion || !$latestVersion->isNewer($currentVersion)) {
            return response()->json([
                'error' => true,
                'message' => 'No update available',
            ], 404);
        }
        
        $downloadUrl = $latestVersion->download_url;
        
        // If no external download URL is set, use our local endpoint
        if (empty($downloadUrl)) {
            $downloadUrl = route('api.cms.download');
        }
        
        return response()->json([
            'data' => [
                'version' => $latestVersion->version,
                'link' => $downloadUrl,
            ]
        ]);
    }
    
    /**
     * Download the CMS update package
     * 
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request)
    {
        $version = $request->input('version');
        
        // If version is specified, get that version, otherwise get latest
        if ($version) {
            $versionModel = CmsVersion::where('version', $version)
                ->where('is_active', true)
                ->first();
        } else {
            $versionModel = CmsVersion::getLatest();
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