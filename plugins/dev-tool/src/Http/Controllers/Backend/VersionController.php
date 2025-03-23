<?php

namespace Mojarsoft\DevTool\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Mojarsoft\DevTool\Models\CmsVersion;
use Mojarsoft\DevTool\Models\PackageVersion;

class VersionController extends BackendController
{
    /**
     * Display a listing of CMS versions.
     *
     * @return \Illuminate\View\View
     */
    public function indexCmsVersions()
    {
        $this->addBreadcrumb([
            'title' => __('Dev Tool'),
            'url' => route('admin.dev-tool.cms-versions.index')
        ]);
        
        $title = __('CMS Versions');
        
        return view('dev-tool::backend.version.cms.index', compact('title'));
    }
    
    /**
     * Show the form for creating a new CMS version.
     *
     * @return \Illuminate\View\View
     */
    public function createCmsVersion()
    {
        $this->addBreadcrumb([
            'title' => __('Dev Tool'),
            'url' => route('admin.dev-tool.cms-versions.index')
        ]);
        
        $this->addBreadcrumb([
            'title' => __('CMS Versions'),
            'url' => route('admin.dev-tool.cms-versions.index')
        ]);
        
        $title = __('Create CMS Version');
        
        return view('dev-tool::backend.version.cms.form', compact('title'));
    }
    
    /**
     * Store a newly created CMS version in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCmsVersion(Request $request)
    {
        $this->validate($request, [
            'version' => 'required|string|unique:dev_tool_cms_versions,version',
            'description' => 'nullable|string',
            'download_url' => 'nullable|url',
            'package_file' => 'nullable|file|mimes:zip',
            'changelog' => 'nullable|string',
        ]);
        
        $data = $request->only(['version', 'description', 'download_url', 'changelog']);
        
        // Handle file upload if present
        if ($request->hasFile('package_file')) {
            $file = $request->file('package_file');
            $path = 'cms/updates/' . $data['version'] . '/' . $file->getClientOriginalName();
            Storage::disk('local')->put($path, file_get_contents($file));
            $data['file_path'] = $path;
        }
        
        CmsVersion::create($data);
        
        return redirect()
            ->route('admin.dev-tool.cms-versions.index')
            ->with('success', __('CMS version created successfully.'));
    }
    
    /**
     * Show the form for editing the specified CMS version.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editCmsVersion($id)
    {
        $version = CmsVersion::findOrFail($id);
        
        $this->addBreadcrumb([
            'title' => __('Dev Tool'),
            'url' => route('admin.dev-tool.cms-versions.index')
        ]);
        
        $this->addBreadcrumb([
            'title' => __('CMS Versions'),
            'url' => route('admin.dev-tool.cms-versions.index')
        ]);
        
        $title = __('Edit CMS Version');
        
        return view('dev-tool::backend.version.cms.form', compact('title', 'version'));
    }
    
    /**
     * Update the specified CMS version in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCmsVersion(Request $request, $id)
    {
        $version = CmsVersion::findOrFail($id);
        
        $this->validate($request, [
            'version' => 'required|string|unique:dev_tool_cms_versions,version,' . $id,
            'description' => 'nullable|string',
            'download_url' => 'nullable|url',
            'package_file' => 'nullable|file|mimes:zip',
            'changelog' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        
        $data = $request->only(['version', 'description', 'download_url', 'changelog', 'is_active']);
        
        // Handle file upload if present
        if ($request->hasFile('package_file')) {
            // Delete old file if exists
            if ($version->file_path) {
                Storage::disk('local')->delete($version->file_path);
            }
            
            $file = $request->file('package_file');
            $path = 'cms/updates/' . $data['version'] . '/' . $file->getClientOriginalName();
            Storage::disk('local')->put($path, file_get_contents($file));
            $data['file_path'] = $path;
        }
        
        $version->update($data);
        
        return redirect()
            ->route('admin.dev-tool.cms-versions.index')
            ->with('success', __('CMS version updated successfully.'));
    }
    
    /**
     * Remove the specified CMS version from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyCmsVersion($id)
    {
        $version = CmsVersion::findOrFail($id);
        
        // Delete file if exists
        if ($version->file_path) {
            Storage::disk('local')->delete($version->file_path);
        }
        
        $version->delete();
        
        return redirect()
            ->route('admin.dev-tool.cms-versions.index')
            ->with('success', __('CMS version deleted successfully.'));
    }
    
    /**
     * Display a listing of package versions.
     *
     * @return \Illuminate\View\View
     */
    public function indexPackageVersions()
    {
        $this->addBreadcrumb([
            'title' => __('Dev Tool'),
            'url' => route('admin.dev-tool.package-versions.index')
        ]);
        
        $title = __('Package Versions');
        
        return view('dev-tool::backend.version.package.index', compact('title'));
    }
    
    /**
     * Show the form for creating a new package version.
     *
     * @return \Illuminate\View\View
     */
    public function createPackageVersion()
    {
        $this->addBreadcrumb([
            'title' => __('Dev Tool'),
            'url' => route('admin.dev-tool.package-versions.index')
        ]);
        
        $this->addBreadcrumb([
            'title' => __('Package Versions'),
            'url' => route('admin.dev-tool.package-versions.index')
        ]);
        
        $title = __('Create Package Version');
        
        return view('dev-tool::backend.version.package.form', compact('title'));
    }
    
    /**
     * Store a newly created package version in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePackageVersion(Request $request)
    {
        $this->validate($request, [
            'package_name' => 'required|string',
            'package_type' => 'required|in:plugin,theme',
            'version' => 'required|string',
            'description' => 'nullable|string',
            'download_url' => 'nullable|url',
            'package_file' => 'nullable|file|mimes:zip',
            'changelog' => 'nullable|string',
            'requires_cms_version' => 'nullable|string',
        ]);
        
        $data = $request->only([
            'package_name', 
            'package_type', 
            'version', 
            'description', 
            'download_url', 
            'changelog',
            'requires_cms_version'
        ]);
        
        // Check for duplicate
        $exists = PackageVersion::where('package_name', $data['package_name'])
            ->where('package_type', $data['package_type'])
            ->where('version', $data['version'])
            ->exists();
            
        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'version' => __('This version already exists for this package')
            ]);
        }
        
        // Handle file upload if present
        if ($request->hasFile('package_file')) {
            $file = $request->file('package_file');
            $path = $data['package_type'] . 's/updates/' . 
                    $data['package_name'] . '/' . 
                    $data['version'] . '/' . 
                    $file->getClientOriginalName();
                    
            Storage::disk('local')->put($path, file_get_contents($file));
            $data['file_path'] = $path;
        }
        
        PackageVersion::create($data);
        
        return redirect()
            ->route('admin.dev-tool.package-versions.index')
            ->with('success', __('Package version created successfully.'));
    }
    
    /**
     * Show the form for editing the specified package version.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editPackageVersion($id)
    {
        $version = PackageVersion::findOrFail($id);
        
        $this->addBreadcrumb([
            'title' => __('Dev Tool'),
            'url' => route('admin.dev-tool.package-versions.index')
        ]);
        
        $this->addBreadcrumb([
            'title' => __('Package Versions'),
            'url' => route('admin.dev-tool.package-versions.index')
        ]);
        
        $title = __('Edit Package Version');
        
        return view('dev-tool::backend.version.package.form', compact('title', 'version'));
    }
    
    /**
     * Update the specified package version in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePackageVersion(Request $request, $id)
    {
        $version = PackageVersion::findOrFail($id);
        
        $this->validate($request, [
            'package_name' => 'required|string',
            'package_type' => 'required|in:plugin,theme',
            'version' => 'required|string',
            'description' => 'nullable|string',
            'download_url' => 'nullable|url',
            'package_file' => 'nullable|file|mimes:zip',
            'changelog' => 'nullable|string',
            'requires_cms_version' => 'nullable|string',
            'is_active' => 'boolean',
        ]);
        
        $data = $request->only([
            'package_name', 
            'package_type', 
            'version', 
            'description', 
            'download_url', 
            'changelog',
            'requires_cms_version',
            'is_active'
        ]);
        
        // Check for duplicate (excluding current record)
        $exists = PackageVersion::where('package_name', $data['package_name'])
            ->where('package_type', $data['package_type'])
            ->where('version', $data['version'])
            ->where('id', '!=', $id)
            ->exists();
            
        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'version' => __('This version already exists for this package')
            ]);
        }
        
        // Handle file upload if present
        if ($request->hasFile('package_file')) {
            // Delete old file if exists
            if ($version->file_path) {
                Storage::disk('local')->delete($version->file_path);
            }
            
            $file = $request->file('package_file');
            $path = $data['package_type'] . 's/updates/' . 
                    $data['package_name'] . '/' . 
                    $data['version'] . '/' . 
                    $file->getClientOriginalName();
                    
            Storage::disk('local')->put($path, file_get_contents($file));
            $data['file_path'] = $path;
        }
        
        $version->update($data);
        
        return redirect()
            ->route('admin.dev-tool.package-versions.index')
            ->with('success', __('Package version updated successfully.'));
    }
    
    /**
     * Remove the specified package version from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyPackageVersion($id)
    {
        $version = PackageVersion::findOrFail($id);
        
        // Delete file if exists
        if ($version->file_path) {
            Storage::disk('local')->delete($version->file_path);
        }
        
        $version->delete();
        
        return redirect()
            ->route('admin.dev-tool.package-versions.index')
            ->with('success', __('Package version deleted successfully.'));
    }
} 