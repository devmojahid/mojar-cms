<?php

namespace Mojarsoft\DevTool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CmsVersion extends Model
{
    protected $table = 'dev_tool_cms_versions';
    
    protected $fillable = [
        'version',
        'description',
        'file_path',
        'download_url',
        'is_active',
        'changelog',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    /**
     * Check if this version is newer than the current CMS version
     *
     * @param string $currentVersion
     * @return bool
     */
    public function isNewer(string $currentVersion): bool
    {
        // Normalize versions for comparison
        $thisVersion = get_version_by_tag($this->version);
        $currentVersionNormalized = get_version_by_tag($currentVersion);
        
        return version_compare($thisVersion, $currentVersionNormalized, '>');
    }
    
    /**
     * Get the latest active version
     *
     * @return self|null
     */
    public static function getLatest(): ?self
    {
        return self::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->first();
    }
    
    /**
     * Get the full file path for the update package
     *
     * @return string|null
     */
    public function getFullPath(): ?string
    {
        if (empty($this->file_path)) {
            return null;
        }
        
        // Try the standard storage path first
        $path = Storage::path($this->file_path);
        
        if (file_exists($path)) {
            return $path;
        }
        
        // If the file doesn't exist with the current path, try some fallbacks
        
        // 1. Try to convert 'public/...' paths to use proper storage_path with public disk
        if (strpos($this->file_path, 'public/') === 0) {
            $publicPath = str_replace('public/', '', $this->file_path);
            $path = Storage::disk('public')->path($publicPath);
            if (file_exists($path)) {
                return $path;
            }
        }
        
        // 2. Try to check if file exists without storage prefix (direct path)
        $directPath = public_path('storage/' . str_replace('public/', '', $this->file_path));
        if (file_exists($directPath)) {
            return $directPath;
        }
        
        // 3. Check if it's using an old path format with local disk
        $localPath = Storage::disk('local')->path($this->file_path);
        if (file_exists($localPath)) {
            return $localPath;
        }
        
        // Log the attempted paths to help with debugging
        \Log::warning("CMS Version: Could not find file with path {$this->file_path}. Tried multiple locations.", [
            'standard_path' => $path,
            'public_disk_path' => $path,
            'direct_public_path' => $directPath,
            'local_disk_path' => $localPath,
        ]);
        
        // Return the original path even if it doesn't exist
        return $path;
    }
} 