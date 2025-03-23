<?php

namespace Mojarsoft\DevTool\Models;

use Illuminate\Database\Eloquent\Model;

class MarketplaceTheme extends Model
{
    protected $table = 'dev_tool_marketplace_themes';
    
    protected $fillable = [
        'name',
        'title',
        'description',
        'screenshot',
        'screenshot_path',
        'banner',
        'banner_path',
        'url',
        'file_path',
        'is_paid',
        'price',
        'is_featured',
        'sort_order',
        'is_active',
    ];
    
    protected $casts = [
        'is_paid' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
    
    /**
     * Get only active themes
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Get featured themes
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
    
    /**
     * Check if the theme has a version available to update
     */
    public function hasUpdateAvailable()
    {
        return PackageVersion::where('package_name', $this->name)
            ->where('package_type', 'theme')
            ->where('is_active', true)
            ->exists();
    }
    
    /**
     * Get the latest version for this theme
     */
    public function getLatestVersion()
    {
        return PackageVersion::where('package_name', $this->name)
            ->where('package_type', 'theme')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->first();
    }
    
    /**
     * Get the effective screenshot source (local or URL)
     */
    public function getScreenshotSrc()
    {
        if (!empty($this->screenshot_path)) {
            return asset('storage/' . $this->screenshot_path);
        }
        
        return $this->screenshot;
    }
    
    /**
     * Get the effective banner source (local or URL)
     */
    public function getBannerSrc()
    {
        if (!empty($this->banner_path)) {
            return asset('storage/' . $this->banner_path);
        }
        
        return $this->banner;
    }
    
    /**
     * Get the download source (local file or URL)
     */
    public function getDownloadSrc()
    {
        if (!empty($this->file_path)) {
            return asset('storage/' . $this->file_path);
        }
        
        return $this->url;
    }
} 