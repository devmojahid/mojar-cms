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
use Illuminate\Pagination\LengthAwarePaginator;


class ThemeController extends ApiController
{
    public function index(Request $request): AnonymousResourceCollection
    {
        // return $this->postController->index($request, 'theme');
        $themes = [
            [
                'name' => 'default',
                'title' => 'Default',
                'description' => "Install\r \r Go to Admin CP -> Themes\r Active Mymo theme\r ",
                'screenshot' => 'https://img.juzaweb.com/themes/default/screenshot.png',
                'banner' => 'https://cdn.juzaweb.com/jw-styles/juzaweb/images/thumb-default.png',
                'url' => 'https://juzaweb.com/product/default-theme',
                'is_paid' => true,
                'price' => null,
                'created_at' => '2022-05-07 03:05:00',
                'updated_at' => '2024-03-24 08:59:00'
            ],
            [
                'name' => 'gamxo',
                'title' => 'Gamxo',
                'description' => 'Install  Go to Admin CP -> Themes  Active theme  ',
                'screenshot' => 'https://img.juzaweb.com/themes/gamxo/screenshot.png',
                'banner' => 'https://cdn.juzaweb.com/jw-styles/juzaweb/images/thumb-default.png',
                'url' => 'https://juzaweb.com/product/gamxo-theme',
                'is_paid' => true,
                'price' => null,
                'created_at' => '2022-05-07 03:05:00',
                'updated_at' => '2023-07-01 12:07:00'
            ],
            [
                'name' => 'mymo',
                'title' => 'Mymo - TV Series And Movie Portal CMS Unlimited',
                'description' => "Overview\r MYMO is a powerful, flexible and User friendly movie & Video Steaming CMS Pro with advance video contents management system. It's easy to use & install. It has been created to...",
                'screenshot' => 'https://img.juzaweb.com/themes/mymo/screenshot.png',
                'banner' => 'https://cdn.juzaweb.com/jw-styles/juzaweb/images/thumb-default.png',
                'url' => 'https://juzaweb.com/product/mymo-theme',
                'is_paid' => true,
                'price' => '$39',
                'created_at' => '2022-05-07 03:05:00',
                'updated_at' => '2024-03-24 05:02:00'
            ]
        ];

        // Create a collection and paginate it
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $collection = collect($themes);

        $paginator = new LengthAwarePaginator(
            $collection,
            $collection->count(),
            $perPage,
            $page,
            ['path' => $request->url()]
        );

        return ThemeResource::collection($paginator);
    }
}

