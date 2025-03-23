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
        
        return Storage::disk('local')->path($this->file_path);
    }
} 