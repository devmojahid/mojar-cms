<?php

namespace Mojarsoft\DevTool\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Mojarsoft\DevTool\Http\Datatables\MarketplaceThemeDatatable;
use Mojarsoft\DevTool\Http\Datatables\MarketplacePluginDatatable;
use Mojarsoft\DevTool\Models\MarketplaceTheme;
use Mojarsoft\DevTool\Models\MarketplacePlugin;

class MarketplaceController extends BackendController
{
    public function index()
    {
        $title = trans('dev-tool::content.marketplace');
        return view('dev-tool::marketplace.index', compact('title'));
    }

    public function getThemeData(Request $request)
    {
        $dataTable = new MarketplaceThemeDatatable();
        return $dataTable->render($request);
    }

    public function getPluginData(Request $request)
    {
        $dataTable = new MarketplacePluginDatatable();
        return $dataTable->render($request);
    }

    public function themeIndex()
    {
        $title = trans('dev-tool::content.themes');
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.marketplace'),
            'url' => route('admin.dev-tool.marketplace')
        ]);
        return view('dev-tool::marketplace.theme_index', compact('title'));
    }

    public function themeCreate()
    {
        $title = trans('dev-tool::content.add_new_theme');
        $model = new MarketplaceTheme();
        
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.marketplace'),
            'url' => route('admin.dev-tool.marketplace')
        ]);
        
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.themes'),
            'url' => route('admin.dev-tool.marketplace-themes.index')
        ]);
        
        return view('dev-tool::marketplace.theme_form', compact('title', 'model'));
    }

    public function themeEdit($id)
    {
        $title = trans('dev-tool::content.edit_theme');
        $model = MarketplaceTheme::findOrFail($id);
        
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.marketplace'),
            'url' => route('admin.dev-tool.marketplace')
        ]);
        
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.themes'),
            'url' => route('admin.dev-tool.marketplace-themes.index')
        ]);
        
        return view('dev-tool::marketplace.theme_form', compact('title', 'model'));
    }

    public function themeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:dev_tool_marketplace_themes,name',
            'title' => 'required|string|max:100',
            'url' => 'nullable|url',
            'screenshot' => 'nullable|url',
            'banner' => 'nullable|url',
            'package_file' => 'nullable|file|mimes:zip|max:50000',
            'screenshot_file' => 'nullable|image|max:5000',
            'banner_file' => 'nullable|image|max:5000'
        ]);
        
        $data = $request->only([
            'name', 'title', 'description', 'screenshot', 'banner', 
            'url', 'is_paid', 'price', 'is_featured', 'sort_order', 'is_active'
        ]);
        
        // Handle package file upload
        if ($request->hasFile('package_file')) {
            $filePath = 'public/marketplace/themes/' . $data['name'] . '.zip';
            Storage::put($filePath, file_get_contents($request->file('package_file')));
            $data['file_path'] = $filePath;
        }
        
        // Handle screenshot upload
        if ($request->hasFile('screenshot_file')) {
            $screenshotPath = 'public/marketplace/themes/screenshots/' . $data['name'] . '.' . $request->file('screenshot_file')->extension();
            Storage::put($screenshotPath, file_get_contents($request->file('screenshot_file')));
            $data['screenshot_path'] = $screenshotPath;
        }
        
        // Handle banner upload
        if ($request->hasFile('banner_file')) {
            $bannerPath = 'public/marketplace/themes/banners/' . $data['name'] . '.' . $request->file('banner_file')->extension();
            Storage::put($bannerPath, file_get_contents($request->file('banner_file')));
            $data['banner_path'] = $bannerPath;
        }

        MarketplaceTheme::create($data);

        return $this->success([
            'message' => trans('dev-tool::content.theme_created_successfully'),
            'redirect' => route('admin.dev-tool.marketplace-themes.index')
        ]);
    }

    public function themeUpdate(Request $request, $id)
    {
        $theme = MarketplaceTheme::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:100|unique:dev_tool_marketplace_themes,name,' . $id,
            'title' => 'required|string|max:100',
            'url' => 'nullable|url',
            'screenshot' => 'nullable|url',
            'banner' => 'nullable|url',
            'package_file' => 'nullable|file|mimes:zip|max:50000',
            'screenshot_file' => 'nullable|image|max:5000',
            'banner_file' => 'nullable|image|max:5000'
        ]);
        
        $data = $request->only([
            'name', 'title', 'description', 'screenshot', 'banner', 
            'url', 'is_paid', 'price', 'is_featured', 'sort_order', 'is_active'
        ]);
        
        // Handle package file upload
        if ($request->hasFile('package_file')) {
            // Delete old file if exists
            if (!empty($theme->file_path)) {
                Storage::delete($theme->file_path);
            }
            
            $filePath = 'public/marketplace/themes/' . $data['name'] . '.zip';
            Storage::put($filePath, file_get_contents($request->file('package_file')));
            $data['file_path'] = $filePath;
        }
        
        // Handle screenshot upload
        if ($request->hasFile('screenshot_file')) {
            // Delete old file if exists
            if (!empty($theme->screenshot_path)) {
                Storage::delete($theme->screenshot_path);
            }
            
            $screenshotPath = 'public/marketplace/themes/screenshots/' . $data['name'] . '.' . $request->file('screenshot_file')->extension();
            Storage::put($screenshotPath, file_get_contents($request->file('screenshot_file')));
            $data['screenshot_path'] = $screenshotPath;
        }
        
        // Handle banner upload
        if ($request->hasFile('banner_file')) {
            // Delete old file if exists
            if (!empty($theme->banner_path)) {
                Storage::delete($theme->banner_path);
            }
            
            $bannerPath = 'public/marketplace/themes/banners/' . $data['name'] . '.' . $request->file('banner_file')->extension();
            Storage::put($bannerPath, file_get_contents($request->file('banner_file')));
            $data['banner_path'] = $bannerPath;
        }

        $theme->update($data);

        return $this->success([
            'message' => trans('dev-tool::content.theme_updated_successfully'),
            'redirect' => route('admin.dev-tool.marketplace-themes.index')
        ]);
    }

    public function themeDestroy($id)
    {
        $theme = MarketplaceTheme::findOrFail($id);
        
        // Delete files if they exist
        if (!empty($theme->file_path)) {
            Storage::delete($theme->file_path);
        }
        
        if (!empty($theme->screenshot_path)) {
            Storage::delete($theme->screenshot_path);
        }
        
        if (!empty($theme->banner_path)) {
            Storage::delete($theme->banner_path);
        }
        
        $theme->delete();

        return $this->success([
            'message' => trans('dev-tool::content.theme_deleted_successfully')
        ]);
    }

    public function pluginIndex()
    {
        $title = trans('dev-tool::content.plugins');
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.marketplace'),
            'url' => route('admin.dev-tool.marketplace')
        ]);
        return view('dev-tool::marketplace.plugin_index', compact('title'));
    }

    public function pluginCreate()
    {
        $title = trans('dev-tool::content.add_new_plugin');
        $model = new MarketplacePlugin();
        
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.marketplace'),
            'url' => route('admin.dev-tool.marketplace')
        ]);
        
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.plugins'),
            'url' => route('admin.dev-tool.marketplace-plugins.index')
        ]);
        
        return view('dev-tool::marketplace.plugin_form', compact('title', 'model'));
    }

    public function pluginEdit($id)
    {
        $title = trans('dev-tool::content.edit_plugin');
        $model = MarketplacePlugin::findOrFail($id);
        
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.marketplace'),
            'url' => route('admin.dev-tool.marketplace')
        ]);
        
        $this->addBreadcrumb([
            'title' => trans('dev-tool::content.plugins'),
            'url' => route('admin.dev-tool.marketplace-plugins.index')
        ]);
        
        return view('dev-tool::marketplace.plugin_form', compact('title', 'model'));
    }

    public function pluginStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:dev_tool_marketplace_plugins,name',
            'title' => 'required|string|max:100',
            'url' => 'nullable|url',
            'thumbnail' => 'nullable|url',
            'banner' => 'nullable|url',
            'package_file' => 'nullable|file|mimes:zip|max:50000',
            'thumbnail_file' => 'nullable|image|max:5000',
            'banner_file' => 'nullable|image|max:5000'
        ]);
        
        $data = $request->only([
            'name', 'title', 'description', 'thumbnail', 'banner', 
            'url', 'is_paid', 'price', 'is_featured', 'sort_order', 'is_active'
        ]);
        
        // Handle package file upload
        if ($request->hasFile('package_file')) {
            $filePath = 'public/marketplace/plugins/' . $data['name'] . '.zip';
            Storage::put($filePath, file_get_contents($request->file('package_file')));
            $data['file_path'] = $filePath;
        }
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail_file')) {
            $thumbnailPath = 'public/marketplace/plugins/thumbnails/' . $data['name'] . '.' . $request->file('thumbnail_file')->extension();
            Storage::put($thumbnailPath, file_get_contents($request->file('thumbnail_file')));
            $data['thumbnail_path'] = $thumbnailPath;
        }
        
        // Handle banner upload
        if ($request->hasFile('banner_file')) {
            $bannerPath = 'public/marketplace/plugins/banners/' . $data['name'] . '.' . $request->file('banner_file')->extension();
            Storage::put($bannerPath, file_get_contents($request->file('banner_file')));
            $data['banner_path'] = $bannerPath;
        }

        MarketplacePlugin::create($data);

        return $this->success([
            'message' => trans('dev-tool::content.plugin_created_successfully'),
            'redirect' => route('admin.dev-tool.marketplace-plugins.index')
        ]);
    }

    public function pluginUpdate(Request $request, $id)
    {
        $plugin = MarketplacePlugin::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:100|unique:dev_tool_marketplace_plugins,name,' . $id,
            'title' => 'required|string|max:100',
            'url' => 'nullable|url',
            'thumbnail' => 'nullable|url',
            'banner' => 'nullable|url',
            'package_file' => 'nullable|file|mimes:zip|max:50000',
            'thumbnail_file' => 'nullable|image|max:5000',
            'banner_file' => 'nullable|image|max:5000'
        ]);
        
        $data = $request->only([
            'name', 'title', 'description', 'thumbnail', 'banner', 
            'url', 'is_paid', 'price', 'is_featured', 'sort_order', 'is_active'
        ]);
        
        // Handle package file upload
        if ($request->hasFile('package_file')) {
            // Delete old file if exists
            if (!empty($plugin->file_path)) {
                Storage::delete($plugin->file_path);
            }
            
            $filePath = 'public/marketplace/plugins/' . $data['name'] . '.zip';
            Storage::put($filePath, file_get_contents($request->file('package_file')));
            $data['file_path'] = $filePath;
        }
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail_file')) {
            // Delete old file if exists
            if (!empty($plugin->thumbnail_path)) {
                Storage::delete($plugin->thumbnail_path);
            }
            
            $thumbnailPath = 'public/marketplace/plugins/thumbnails/' . $data['name'] . '.' . $request->file('thumbnail_file')->extension();
            Storage::put($thumbnailPath, file_get_contents($request->file('thumbnail_file')));
            $data['thumbnail_path'] = $thumbnailPath;
        }
        
        // Handle banner upload
        if ($request->hasFile('banner_file')) {
            // Delete old file if exists
            if (!empty($plugin->banner_path)) {
                Storage::delete($plugin->banner_path);
            }
            
            $bannerPath = 'public/marketplace/plugins/banners/' . $data['name'] . '.' . $request->file('banner_file')->extension();
            Storage::put($bannerPath, file_get_contents($request->file('banner_file')));
            $data['banner_path'] = $bannerPath;
        }

        $plugin->update($data);

        return $this->success([
            'message' => trans('dev-tool::content.plugin_updated_successfully'),
            'redirect' => route('admin.dev-tool.marketplace-plugins.index')
        ]);
    }

    public function pluginDestroy($id)
    {
        $plugin = MarketplacePlugin::findOrFail($id);
        
        // Delete files if they exist
        if (!empty($plugin->file_path)) {
            Storage::delete($plugin->file_path);
        }
        
        if (!empty($plugin->thumbnail_path)) {
            Storage::delete($plugin->thumbnail_path);
        }
        
        if (!empty($plugin->banner_path)) {
            Storage::delete($plugin->banner_path);
        }
        
        $plugin->delete();

        return $this->success([
            'message' => trans('dev-tool::content.plugin_deleted_successfully')
        ]);
    }
} 