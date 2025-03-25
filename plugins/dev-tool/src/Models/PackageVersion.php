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
        $latestVersion = self::where('package_name', $packageName)
            ->where('package_type', $packageType)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->first();
            
        // If we're looking for a plugin and it doesn't exist in our database
        // but it exists in the marketplace, create a version entry for it
        if (!$latestVersion && $packageType === 'plugin') {
            $latestVersion = self::createFromMarketplace($packageName);
        }
            
        return $latestVersion;
    }
    
    /**
     * Create a package version from marketplace data if available
     * 
     * @param string $packageName 
     * @return self|null
     */
    public static function createFromMarketplace(string $packageName): ?self
    {
        try {
            // Look for the plugin in the marketplace
            $marketplace = \Mojarsoft\DevTool\Models\MarketplacePlugin::where('name', $packageName)
                ->where('is_active', true)
                ->first();
                
            if (!$marketplace) {
                \Log::info("Plugin {$packageName} not found in marketplace");
                return null;
            }
            
            // Check if the plugin has a download URL
            if (empty($marketplace->url)) {
                \Log::warning("Plugin {$packageName} found in marketplace but has no download URL");
                return null;
            }
            
            \Log::info("Creating package version entry for {$packageName} from marketplace");
            
            // Create a new package version entry
            $version = new self();
            $version->package_name = $packageName;
            $version->package_type = 'plugin';
            $version->version = '1.0.0'; // Default initial version
            $version->download_url = $marketplace->url;
            $version->is_active = true;
            $version->description = $marketplace->description ?? '';
            $version->save();
            
            \Log::info("Created new package version for {$packageName}", [
                'version' => $version->toArray()
            ]);
            
            return $version;
        } catch (\Exception $e) {
            \Log::error("Failed to create package version from marketplace: {$e->getMessage()}", [
                'exception' => $e
            ]);
            return null;
        }
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