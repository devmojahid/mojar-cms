<?php

/**
 * Mojar CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\API\Http\Controllers;

use Illuminate\Http\Request;
use Juzaweb\Backend\Http\Resources\ThemeResource;
use Juzaweb\CMS\Http\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Mojarsoft\DevTool\Models\MarketplaceTheme;

class ThemeController extends ApiController
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = MarketplaceTheme::query()
            ->where('is_active', true)
            ->orderBy('is_featured', 'DESC')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('created_at', 'DESC');
            
        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('title', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }
        
        if ($request->has('is_paid')) {
            $query->where('is_paid', $request->get('is_paid'));
        }
        
        if ($request->has('is_featured')) {
            $query->where('is_featured', $request->get('is_featured'));
        }
        
        $perPage = $request->get('per_page', 10);
        $themes = $query->paginate($perPage);
        
        return ThemeResource::collection($themes);
    }
}

