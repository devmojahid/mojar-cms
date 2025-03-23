<?php

namespace Mojarsoft\DevTool\Models;

use Illuminate\Database\Eloquent\Model;

class MarketplacePlugin extends Model
{
    protected $table = 'dev_tool_marketplace_plugins';
    
    protected $fillable = [
        'name',
        'title',
        'description',
        'thumbnail',
        'thumbnail_path',
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
     * Get only active plugins
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Get featured plugins
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
    
    /**
     * Check if the plugin has a version available to update
     */
    public function hasUpdateAvailable()
    {
        return PackageVersion::where('package_name', $this->name)
            ->where('package_type', 'plugin')
            ->where('is_active', true)
            ->exists();
    }
    
    /**
     * Get the latest version for this plugin
     */
    public function getLatestVersion()
    {
        return PackageVersion::where('package_name', $this->name)
            ->where('package_type', 'plugin')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->first();
    }
    
    /**
     * Get the effective thumbnail source (local or URL)
     */
    public function getThumbnailSrc()
    {
        if (!empty($this->thumbnail_path)) {
            return asset('storage/' . $this->thumbnail_path);
        }
        
        return $this->thumbnail;
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