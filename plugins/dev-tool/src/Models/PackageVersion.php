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
        \Log::warning("Package Version: Could not find file with path {$this->file_path}. Tried multiple locations.", [
            'package' => "{$this->package_type}/{$this->package_name} v{$this->version}",
            'standard_path' => $path,
            'public_disk_path' => $path,
            'direct_public_path' => $directPath,
            'local_disk_path' => $localPath,
        ]);
        
        // Return the original path even if it doesn't exist
        return $path;
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