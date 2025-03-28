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
        
        try {
            // Log what we're trying to do
            \Log::info("CMS update request:", [
                'current_version' => $currentVersion
            ]);
            
            // Get latest version from the database
            $latestVersion = CmsVersion::getLatest();
            
            if (!$latestVersion) {
                \Log::info("No CMS version found in database");
                return response()->json([
                    'status' => false,
                    'data' => ['message' => 'No update available']
                ]);
            }
            
            if (!$latestVersion->isNewer($currentVersion)) {
                \Log::info("CMS is already at the latest version");
                return response()->json([
                    'status' => false,
                    'data' => ['message' => 'No update available']
                ]);
            }
            
            $downloadUrl = $latestVersion->download_url ?: route('api.api.cms.download', ['version' => $latestVersion->version]);
            
            // Log the download URL for debugging
            \Log::info("CMS update response:", [
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
            \Log::info("Full CMS update response:", ['response' => $response]);
            
            return response()->json($response);
        } catch (\Exception $e) {
            \Log::error("CMS update check failed: {$e->getMessage()}", [
                'exception' => $e
            ]);
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Update check failed: ' . $e->getMessage()]
            ]);
        }
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
        
        // Log download request for debugging
        \Log::info("CMS download request:", [
            'version' => $version
        ]);
        
        try {
            // If version is specified, get that version, otherwise get latest
            if ($version) {
                $versionModel = CmsVersion::where('version', $version)
                    ->where('is_active', true)
                    ->first();
            } else {
                $versionModel = CmsVersion::getLatest();
            }
            
            if (!$versionModel) {
                \Log::error("Download failed: No CMS version found");
                return response()->json([
                    'error' => true,
                    'message' => 'CMS version not found',
                ], 404);
            }
            
            if (!$versionModel->file_path) {
                \Log::error("Download failed: No file path for CMS version {$versionModel->version}");
                return response()->json([
                    'error' => true,
                    'message' => 'CMS package file path not defined',
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
                    'message' => 'CMS package file not found',
                ], 404);
            }
            
            \Log::info("Serving CMS download:", [
                'version' => $versionModel->version,
                'file' => $filePath
            ]);
            
            $downloadFilename = 'cms-' . $versionModel->version . '.zip';
            
            return response()->download($filePath, $downloadFilename);
        } catch (\Exception $e) {
            \Log::error("Error downloading CMS: " . $e->getMessage(), [
                'exception' => $e
            ]);
            return response()->json([
                'error' => true,
                'message' => 'Error downloading CMS: ' . $e->getMessage(),
            ], 500);
        }
    }
} 