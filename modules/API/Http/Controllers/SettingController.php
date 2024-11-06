<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Mojar\API\Http\Controllers;

use Illuminate\Support\Arr;
use Mojar\CMS\Contracts\ConfigContract;
use Mojar\CMS\Contracts\HookActionContract;
use Mojar\CMS\Contracts\ThemeConfigContract;
use Mojar\CMS\Facades\Theme;
use Mojar\CMS\Http\Controllers\ApiController;

class SettingController extends ApiController
{
    public function __construct(
        protected HookActionContract $hookAction,
        protected ThemeConfigContract $themeConfig,
        protected ConfigContract $configContract
    ) {}

    public function index(): \Illuminate\Http\JsonResponse
    {
        $showApiKeys = $this->hookAction->getConfigs()->where('show_api', true)->keys()->toArray();
        $configs = $this->configContract->getConfigs($showApiKeys);
        $configs['recaptcha_site_key'] = $this->configContract->getConfig('google_captcha.site_key');
        $types = $this->hookAction->getPostTypes()->map(
            function ($item) {
                return Arr::only(
                    $item->toArray(),
                    ['label', 'description', 'key', 'singular', 'supports']
                );
            }
        );

        /*$taxonomies = $this->hookAction->getTaxonomies()->map(
            function ($item) {
                dd($item);
                return Arr::only(
                    $item,
                    ['label', 'label_type', 'key', 'post_type', 'supports', 'singular', 'taxonomy']
                );
            }
        );*/

        $permalinks = collect($this->hookAction->getPermalinks())->keyBy('base')->map(
            function ($item) {
                return Arr::only(
                    $item->toArray(),
                    ['label', 'base', 'key', 'post_type']
                );
            }
        );

        $register = Arr::only(
            Theme::find(jw_current_theme())->getRegister(),
            ['templates', 'sidebars', 'widgets', 'blocks', 'nav_menus']
        );

        return $this->restSuccess(
            [
                'general' => $configs,
                'post_types' => $types,
                'permalinks' => $permalinks,
                'register' => $register,
                //'taxonomies' => $taxonomies,
            ]
        );
    }
}
