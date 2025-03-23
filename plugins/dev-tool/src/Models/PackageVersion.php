<?php

namespace Mojarsoft\DevTool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PackageVersion extends Model
{
    protected $table = 'dev_tool_package_versions';
    
    protected $fillable = [
        'package_name',
        'package_type', // 'plugin' or 'theme'
        'version',
        'description',
        'file_path',
        'download_url',
        'is_active',
        'changelog',
        'requires_cms_version',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    /**
     * Check if this version is newer than the provided version
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
     * Get the latest active version for a package
     *
     * @param string $packageName
     * @param string $packageType
     * @return self|null
     */
    public static function getLatest(string $packageName, string $packageType): ?self
    {
        return self::where('package_name', $packageName)
            ->where('package_type', $packageType)
            ->where('is_active', true)
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
    
    /**
     * Scope for plugins
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePlugins($query)
    {
        return $query->where('package_type', 'plugin');
    }
    
    /**
     * Scope for themes
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeThemes($query)
    {
        return $query->where('package_type', 'theme');
    }
} 