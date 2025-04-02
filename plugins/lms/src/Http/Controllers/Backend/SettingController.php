<?php

namespace Mojahid\Lms\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Juzaweb\Backend\Http\Controllers\Backend\PageController;
use Juzaweb\CMS\Models\Role;

class SettingController extends PageController
{
    public function index()
    {
        $title = trans('lms::content.setting');
        
        // Get all countries for country dropdown
        $countries = $this->getCountriesList();
        
        // Get all pages for page selection dropdowns
        $pages = [];
        
        // Get available roles for student role dropdown
        $roles = $this->getAvailableRoles();
        
        return view(
            'lms::backend.setting.index',
            compact(
                'title',
                'countries',
                'pages',
                'roles'
            )
        );
    }
    
    public function save(Request $request)
    {
        do_action('juzaweb.setting.save', $request);
        
        return $this->success([
            'message' => trans('cms::app.saved_successfully'),
            'redirect' => route('admin.lms.setting')
        ]);
    }
    
    /**
     * Get countries list for dropdown
     */
    protected function getCountriesList(): array
    {
        // This is a placeholder - you might want to use a proper countries list
        return [
            'us' => 'United States',
            'uk' => 'United Kingdom',
            'ca' => 'Canada',
            'au' => 'Australia',
            'in' => 'India',
            'fr' => 'France',
            'de' => 'Germany',
            'jp' => 'Japan',
            'br' => 'Brazil',
            'es' => 'Spain',
            'it' => 'Italy',
            'mx' => 'Mexico',
            'sg' => 'Singapore',
            'nl' => 'Netherlands',
            'bd' => 'Bangladesh',
            // Add more countries as needed
        ];
    }
    
    /**
     * Get pages list for page selection dropdowns
     */
    protected function getPagesList(): array
    {
        $pages = get_posts([
            'post_type' => 'pages',
            'status' => 'publish',
        ]);
        
        return $pages->mapWithKeys(function ($page) {
            return [$page->id => $page->title];
        })->toArray();
    }
    
    /**
     * Get available roles for student role dropdown
     */
    protected function getAvailableRoles(): array
    {
        $roles = Role::all();
        
        return $roles->mapWithKeys(function ($role) {
            return [$role->name => $role->name];
        })->toArray();
    }
}
