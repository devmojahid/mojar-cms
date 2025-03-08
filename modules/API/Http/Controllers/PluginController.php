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
use Juzaweb\Backend\Http\Resources\PluginResource;
use Juzaweb\CMS\Http\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Juzaweb\CMS\Facades\JWQuery;

class PluginController extends ApiController
{

    public function index(Request $request): AnonymousResourceCollection
    {
        $plugins = $this->getPlugins();
        // Create a collection and paginate it
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $collection = collect($plugins);

        $paginator = new LengthAwarePaginator(
            $collection,
            $collection->count(),
            $perPage,
            $page,
            ['path' => $request->url()]
        );

        return PluginResource::collection($paginator);
    }

    private function getPlugins()
{
    try {
        // Check if JWQuery::posts returns an object or collection that supports select()
        $query = JWQuery::posts('dev_tool_plugin');
        
        // If $query is already an array, we can't call select() on it
        if (is_array($query)) {
            // Just work with the array directly
            $plugins = collect($query)->map(function ($plugin) {
                return [
                    'name' => $plugin['name'] ?? '',
                    'title' => $plugin['title'] ?? '',
                    'thumbnail' => $plugin['thumbnail'] ?? 'https://via.placeholder.com/590x300.png',
                    'description' => $plugin['description'] ?? '',
                    'url' => $plugin['url'] ?? 'https://juzaweb.com/juzaweb/movie',
                    'created_at' => $plugin['created_at'] ?? now()->format('Y-m-d H:i:s'),
                    'updated_at' => $plugin['updated_at'] ?? now()->format('Y-m-d H:i:s')
                ];
            })->toArray();
        } else {
            // Original approach if $query supports select()
            $plugins = $query->select([
                'id',
                'name',
                'title',
                'thumbnail',
                'description',
                'url',
                'created_at',
                'updated_at'
            ])
            ->get()
            ->map(function ($plugin) {
                return [
                    'name' => $plugin->name ?? '',
                    'title' => $plugin->title ?? '',
                    'thumbnail' => $plugin->thumbnail ?? 'https://via.placeholder.com/590x300.png',
                    'description' => $plugin->description ?? '',
                    'url' => $plugin->url ?? '',
                    'created_at' => $plugin->created_at?->format('Y-m-d H:i:s') ?? now()->format('Y-m-d H:i:s'),
                    'updated_at' => $plugin->updated_at?->format('Y-m-d H:i:s') ?? now()->format('Y-m-d H:i:s')
                ];
            })
            ->toArray();
        }

        return !empty($plugins) ? $plugins : [
            // Fallback data if no plugins found
            [
                'name' => 'juzaweb/movie',
                'title' => 'Movie Plugin - Easily Create Movie Website',
                'thumbnail' => 'https://img.juzaweb.com/plugins/juzaweb/movie/screenshot.png',
                'description' => 'Movie JuzaCMS Plugin About The Movie plugin...',
                'url' => 'https://juzaweb.com/juzaweb/movie',
                'created_at' => '2022-05-07 06:22:00',
                'updated_at' => '2024-04-18 08:40:00'
            ],
            // ... other fallback plugins
        ];

    } catch (\Exception $e) {
        \Log::error('Plugin fetch error: ' . $e->getMessage());
        // Return fallback data in case of error
        return [
            [
                'name' => 'juzaweb/movie',
                'title' => 'Movie Plugin - Easily Create Movie Website',
                'thumbnail' => 'https://img.juzaweb.com/plugins/juzaweb/movie/screenshot.png',
                'description' => 'Movie JuzaCMS Plugin About The Movie plugin...',
                'url' => 'https://juzaweb.com/juzaweb/movie',
                'created_at' => '2022-05-07 06:22:00',
                'updated_at' => '2024-04-18 08:40:00'
            ],
            // ... other fallback data
        ];
    }
}
    private function getPluginsOld()
    {
        // return JWQuery::posts('dev_tool_plugin');

        return [
            [
                'name' => 'juzaweb/movie',
                'title' => 'Movie Plugin - Easily Create Movie Website',
                'thumbnail' => 'https://img.juzaweb.com/plugins/juzaweb/movie/screenshot.png',
                'description' => 'Movie JuzaCMS Plugin About The Movie plugin compliments your content by adding information about the movies, the television shows and the people in the industry you choose. Install ...',
                'url' => 'https://juzaweb.com/juzaweb/movie',
                'created_at' => '2022-05-07 06:22:00',
                'updated_at' => '2024-04-18 08:40:00'
            ],
            [
                'name' => 'juzaweb/demo-site',
                'title' => 'Demo Site',
                'thumbnail' => 'https://via.placeholder.com/590x300.png/002266?text=Demo+Site',
                'description' => 'Demo Site JuzaCMS Plugin Features:   Add user admin demo  Autocomplete user demo  ',
                'url' => 'https://juzaweb.com/juzaweb/demo-site',
                'created_at' => '2022-05-07 06:22:00',
                'updated_at' => '2024-03-24 03:38:00'
            ],
            [
                'name' => 'juzaweb/ads-manager',
                'title' => 'Ads Management',
                'thumbnail' => 'https://via.placeholder.com/590x300.png/009911?text=Ads+Management',
                'description' => 'Ads Management Plugin About Add html ads to your website Install  Go to Admin -> Plugins -> Add new  Search and Ads Management plugin  ',
                'url' => 'https://juzaweb.com/juzaweb/ads-manager',
                'created_at' => '2022-05-07 06:22:00',
                'updated_at' => '2024-03-24 03:38:00'
            ],
        ];
    }
}

