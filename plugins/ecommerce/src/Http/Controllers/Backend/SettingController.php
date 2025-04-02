<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Juzaweb\Backend\Http\Controllers\Backend\PageController;
use Juzaweb\CMS\Models\Role;

class SettingController extends PageController
{
    public function index()
    {
        $title = trans('ecomm::content.setting');
        
        // Get all countries for country dropdown
        $countries = $this->getCountriesList();
        
        // Get all pages for page selection dropdowns
        $pages = $this->getPagesList();
        
        return view(
            'ecomm::backend.setting.index',
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
            'redirect' => route('admin.ecommerce.setting')
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
        $pages = \Juzaweb\Backend\Models\Post::whereType('pages')
            ->get(['id', 'title'])
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->title];
            })
            ->toArray();
        
        return array_replace(['' => __('Select page')], $pages);
    }
}
