<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Support\HookActions\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait MenuHookAction
{
    public function addAdminMenu(string $menuTitle, string $menuSlug, array $args = []): void
    {
        $adminMenu = $this->globalData->get('admin_menu');

        $opts = [
            'title' => $menuTitle,
            'key' => $menuSlug,
            'permissions' => ['admin'],
            'slug' => Str::replace('.', '-', $menuSlug),
            'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-point"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /></svg>',
            'icon_type' => 'font-awesome',
            'url' => Str::replace('.', '/', $menuSlug),
            'parent' => null,
            'position' => 20,
            'turbolinks' => true,
        ];

        $item = array_merge($opts, $args);
        if ($item['parent']) {
            $adminMenu[$item['parent']]['children'][$item['key']] = $item;
        } else {
            if (Arr::has($adminMenu, $item['key'])) {
                if (Arr::has($adminMenu[$item['key']], 'children')) {
                    $item['children'] = $adminMenu[$item['key']]['children'];
                }

                $adminMenu[$item['key']] = $item;
            } else {
                $adminMenu[$item['key']] = $item;
            }
        }

        $this->globalData->set('admin_menu', $adminMenu);
    }

    public function addMasterAdminMenu(string $menuTitle, string $menuSlug, array $args = []): void
    {
        $adminMenu = $this->globalData->get('master_admin_menu');

        $opts = [
            'title' => $menuTitle,
            'key' => $menuSlug,
            'slug' => str_replace('.', '-', $menuSlug),
            'icon' => 'fa fa-list-ul',
            'icon_type' => 'font-awesome',
            'url' => str_replace('.', '/', $menuSlug),
            'parent' => null,
            'position' => 20,
            'turbolinks' => true,
        ];

        $item = array_merge($opts, $args);
        if ($item['parent']) {
            $adminMenu[$item['parent']]['children'][$item['key']] = $item;
        } else {
            if (Arr::has($adminMenu, $item['key'])) {
                if (Arr::has($adminMenu[$item['key']], 'children')) {
                    $item['children'] = $adminMenu[$item['key']]['children'];
                }

                $adminMenu[$item['key']] = $item;
            } else {
                $adminMenu[$item['key']] = $item;
            }
        }

        $this->globalData->set('master_admin_menu', $adminMenu);
    }

    public function registerNavMenus(array $locations = []): void
    {
        foreach ($locations as $key => $location) {
            $this->globalData->set(
                'nav_menus.' . $key,
                new Collection(
                    [
                        'key' => $key,
                        'location' => $location,
                    ]
                )
            );
        }
    }
}
