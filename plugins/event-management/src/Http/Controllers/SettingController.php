<?php

namespace Mojahid\EventManagement\Http\Controllers;

use Illuminate\Http\Request;
use Juzaweb\Backend\Http\Controllers\Backend\PageController;
use Juzaweb\CMS\Models\Config;

class SettingController extends PageController
{
    public function index()
    {
        $title = trans('evman::content.setting');
        
        // Get all countries for country dropdown
        $countries = $this->getCountriesList();
        
        // Get all pages for page selection dropdowns
        $pages = [];
        
        return view(
            'evman::backend.setting.index',
            compact(
                'title',
                'countries',
                'pages'
            )
        );
    }
    
    public function save(Request $request)
    {
        do_action('juzaweb.setting.save', $request);
        
        return $this->success([
            'message' => trans('cms::app.saved_successfully'),
            'redirect' => route('admin.event-management.setting')
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
}
