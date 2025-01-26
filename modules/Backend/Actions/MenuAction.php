<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\Backend\Actions;

use Illuminate\Support\Facades\Cache;
use Juzaweb\Backend\Models\Post;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Facades\ThemeLoader;
use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Support\Notification;
use Juzaweb\CMS\Support\Theme\CustomMenuBox;
use Juzaweb\CMS\Support\Updater\CmsUpdater;
use Juzaweb\CMS\Version;
use Juzaweb\Frontend\Http\Controllers\PageController;
use Juzaweb\Frontend\Http\Controllers\PostController;

class MenuAction extends Action
{
    public function handle(): void
    {
        $this->addAction(self::INIT_ACTION, [$this, 'addDatatableSearchFieldTypes']);
        $this->addAction(self::INIT_ACTION, [$this, 'addPostTypes']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addBackendMenu']);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addSettingPage']);
        $this->addAction(self::BACKEND_INIT, [$this, 'addAdminScripts'], 10);
        $this->addAction(self::BACKEND_INIT, [$this, 'addAdminStyles'], 10);
        $this->addAction(self::INIT_ACTION, [$this, 'addMenuBoxs'], 50);
        $this->addAction(self::BACKEND_CALL_ACTION, [$this, 'addTaxonomiesForm']);
        $this->addAction(self::INIT_ACTION, [$this, 'registerEmailHooks']);
        $this->addAction(self::BACKEND_INIT, [$this, 'checkAndNotifyUpdate']);
    }

    public function addBackendMenu(): void
    {
        HookAction::addAdminMenu(
            trans('cms::app.dashboard'),
            'dashboard',
            [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>',
                'position' => 1,
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.media'),
            'media',
            [
                'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder-open"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 19l2.757 -7.351a1 1 0 0 1 .936 -.649h12.307a1 1 0 0 1 .986 1.164l-.996 5.211a2 2 0 0 1 -1.964 1.625h-14.026a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v2" /></svg>',
                'position' => 2,
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.appearance'),
            'appearance',
            [
                'icon' => 'fa fa-paint-brush',
                'icon_type' => 'font-awesome',
                'position' => 45,
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.themes'),
            'themes',
            [
                'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-palette"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" /><path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>',
                'position' => 1,
                'parent' => 'appearance',
                'permissions' => [
                    'themes.index',
                    'themes.edit',
                    'themes.create',
                    'themes.delete',
                ],
            ]
        );

        if (config('mojar.theme.enable_upload')) {
            HookAction::addAdminMenu(
                trans('cms::app.add_new'),
                'theme.install',
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path><path d="M15 12h-6"></path><path d="M12 9v6"></path></svg>',
                    'position' => 1,
                    'parent' => 'appearance',
                    'permissions' => [
                        'themes.create',
                    ],
                ]
            );
        }

        HookAction::addAdminMenu(
            trans('cms::app.widgets'),
            'widgets',
            [
                'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>',
                'position' => 2,
                'parent' => 'appearance',
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.menus'),
            'menus',
            [
                'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-list-details"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 5h8" /><path d="M13 9h5" /><path d="M13 15h8" /><path d="M13 19h5" /><path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /></svg>',
                'position' => 2,
                'parent' => 'appearance',
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.theme_options'),
            'theme.setting',
            [
                'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments-alt"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8h4v4h-4z" /><path d="M6 4l0 4" /><path d="M6 12l0 8" /><path d="M10 14h4v4h-4z" /><path d="M12 4l0 10" /><path d="M12 18l0 2" /><path d="M16 5h4v4h-4z" /><path d="M18 4l0 1" /><path d="M18 9l0 11" /></svg>',
                'position' => 50,
                'parent' => 'appearance',
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.plugins'),
            'plugins',
            [
                'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-apps"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 7l6 0" /><path d="M17 4l0 6" /></svg>',
                'position' => 50,
            ]
        );

        if (config('mojar.plugin.enable_upload')) {
            HookAction::addAdminMenu(
                trans('cms::app.plugins'),
                'plugins',
                [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-apps"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 7l6 0" /><path d="M17 4l0 6" /></svg>',
                    'position' => 1,
                    'parent' => 'plugins',
                    'permissions' => [
                        'plugins.index',
                        'plugins.edit',
                        'plugins.create',
                        'plugins.delete',
                    ],
                ]
            );

            HookAction::addAdminMenu(
                trans('cms::app.add_new'),
                'plugin.install',
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path><path d="M15 12h-6"></path><path d="M12 9v6"></path></svg>',
                    'position' => 1,
                    'parent' => 'plugins',
                    'permissions' => [
                        'plugins.create',
                    ],
                ]
            );
        }

        HookAction::addAdminMenu(
            trans('cms::app.setting'),
            'setting.system',
            [
                'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>',
                'position' => 40,
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.managements'),
            'managements',
            [
                'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tournament"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M20 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M4 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M4 20m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M6 12h3a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-3" /><path d="M6 4h7a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-2" /><path d="M14 10h4" /></svg>',
                'position' => 55,
            ]
        );
    }

    public function addSettingPage(): void
    {
        HookAction::addSettingForm(
            'general',
            [
                'name' => trans('cms::app.general_setting'),
                'view' => 'cms::backend.setting.system.form.general',
                'priority' => 1,
            ]
        );

        HookAction::addSettingForm(
            'email',
            [
                'name' => trans('cms::app.email_setting'),
                'view' => 'cms::backend.email.setting',
                'header' => false,
                'footer' => false,
                'priority' => 50,
            ]
        );

        HookAction::addSettingForm(
            'permalink',
            [
                'name' => trans('cms::app.permalinks'),
                'view' => view(
                     'cms::backend.permalink.index',[
                            'title' => trans('cms::app.permalinks'),
                            'permalinks' => HookAction::getPermalinks(),
                        ]
                     ),
                'priority' => 50,
            ]
        );

        HookAction::addSettingForm(
            'reading',
            [
                'name' => trans('cms::app.reading_settings'),
                'view' => view(
                     'cms::backend.reading.index',[
                            'title' => trans('cms::app.reading_settings'),
                        ]
                     ),
                'priority' => 60,
            ]
        );
    }

    public function addPostTypes(): void
    {
        $templates = ThemeLoader::getTemplates(jw_current_theme());
        $data = [
            'options' => ['' => trans('cms::app.choose_template')],
        ];

        foreach ($templates as $key => $template) {
            $data['options'][$key] = [
                'label' => $template['label'],
                'data' => [
                    'has-block' => ($template['blocks'] ?? 0) ? 1 : 0
                ],
            ];
        }

        HookAction::registerPostType(
            'pages',
            [
                'label' => trans('cms::app.pages'),
                'model' => Post::class,
                'menu_icon' => 'fa fa-edit',
                'icon_type' => 'font-awesome',
                'rewrite' => false,
                'callback' => PageController::class,
                'metas' => [
                    'template' => [
                        'type' => 'select',
                        'label' => trans('cms::app.template'),
                        'sidebar' => true,
                        'data' => $data,
                    ],
                    'block_content' => [
                        'visible' => false,
                        'sidebar' => true,
                    ]
                ]
            ]
        );

        HookAction::registerPostType(
            'posts',
            [
                'label' => trans('cms::app.posts'),
                'model' => Post::class,
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-analytics"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 17l0 -5" /><path d="M12 17l0 -1" /><path d="M15 17l0 -3" /></svg>',
                'icon_type' => 'font-awesome',
                'menu_position' => 15,
                'callback' => PostController::class,
                'supports' => [
                    'category',
                    'tag',
                    'comment',
                ],
            ]
        );
    }

    public function addMenuBoxs(): void
    {
        HookAction::registerMenuBox(
            'custom_url',
            [
                'title' => trans('cms::app.custom_url'),
                'group' => 'custom',
                'menu_box' => new CustomMenuBox(),
            ]
        );
    }

    public function addTaxonomiesForm(): void
    {
        $types = HookAction::getPostTypes();
        foreach ($types as $key => $type) {
            add_action(
                "post_type.{$key}.form.right",
                function ($model) use ($key) {
                    echo view(
                        'cms::components.taxonomies',
                        [
                            'postType' => $key,
                            'model' => $model,
                        ]
                    )->render();
                }
            );
        }
    }

    public function addAdminScripts(): void
    {
        $ver = Version::getVersion();
        HookAction::enqueueScript('core-vendor', 'jw-styles/mojar/js/vendor.min.js', $ver);
        HookAction::enqueueScript('core-backend', 'jw-styles/mojar/js/backend.min.js', $ver);
        HookAction::enqueueScript('core-tinymce', 'jw-styles/mojar/tinymce/tinymce.min.js', $ver);
        HookAction::enqueueScript('core-custom', 'jw-styles/mojar/js/custom.min.js', $ver);
        HookAction::enqueueScript('custom-main-js', 'jw-styles/mojar/js/custom-main.min.js', $ver);
        // Tabler js
        HookAction::enqueueScript('tabler-apexcharts', 'jw-styles/base/assets/libs/apexcharts/dist/apexcharts.min.js', $ver);
        HookAction::enqueueScript('tabler-jsvectormap', 'jw-styles/base/assets/libs/jsvectormap/dist/js/jsvectormap.min.js', $ver);
        HookAction::enqueueScript('tabler-jsvectormap-maps', 'jw-styles/base/assets/libs/jsvectormap/dist/maps/world.js', $ver);
        HookAction::enqueueScript('tabler-jsvectormap-world', 'jw-styles/base/assets/libs/jsvectormap/dist/maps/world-merc.js?1692870487', $ver);
        HookAction::enqueueScript('tabler-main-js', 'jw-styles/base/assets/js/tabler.min.js', $ver);
    }

    public function addAdminStyles(): void
    {
        $ver = Version::getVersion();
        HookAction::enqueueStyle('core-vendor', 'jw-styles/mojar/css/vendor.min.css', $ver);
        // HookAction::enqueueStyle('core-backend', 'jw-styles/mojar/css/backend.min.css', $ver);
        // HookAction::enqueueStyle('core-custom', 'jw-styles/mojar/css/custom.min.css', $ver);
        // Tabler css
        HookAction::enqueueStyle('tabler-main', 'jw-styles/base/assets/css/tabler.min.css', $ver);
        HookAction::enqueueStyle('tabler-flags', 'jw-styles/base/assets/css/tabler-flags.min.css', $ver);
        HookAction::enqueueStyle('tabler-payments', 'jw-styles/base/assets/css/tabler-payments.min.css', $ver);
        HookAction::enqueueStyle('tabler-vendors', 'jw-styles/base/assets/css/tabler-vendors.min.css', $ver);
        HookAction::enqueueStyle('base-custom', 'jw-styles/base/assets/css/custom.css', $ver);
        HookAction::enqueueStyle('base-custom', 'css/app.css', $ver);
    }

    public function addDatatableSearchFieldTypes(): void
    {
        $this->addFilter(
            Action::DATATABLE_SEARCH_FIELD_TYPES_FILTER,
            function ($items) {
                $items['text'] = [
                    'view' => view('cms::components.datatable.text_field'),
                ];

                $items['select'] = [
                    'view' => view('cms::components.datatable.select_field'),
                ];

                $items['taxonomy'] = [
                    'view' => view('cms::components.datatable.taxonomy_field'),
                ];

                return $items;
            }
        );
    }

    public function registerEmailHooks(): void
    {
        HookAction::registerEmailHook(
            'register_success',
            [
                'label' => trans('cms::app.registered_success'),
                'params' => [
                    'name' => trans('cms::app.user_name'),
                    'email' => trans('cms::app.user_email'),
                    'verifyToken' => trans('cms::app.verify_token'),
                ],
            ]
        );
    }

    public function checkAndNotifyUpdate(): void
    {
        $key = cache_prefix('check_cms_update');
        if (Cache::store('file')->has($key)) {
            return;
        }

        $updater = app(CmsUpdater::class);
        $currentVersion = $updater->getCurrentVersion();

        try {
            $versionAvailable = $updater->getVersionAvailable();
        } catch (\Exception $e) {
            report($e);
            $versionAvailable = $currentVersion;
        }

        if (version_compare($versionAvailable, $currentVersion, '>')) {
            $notify = new Notification();
            $notify->setUsers(
                User::where('is_admin', 1)
                    ->active()
                    ->get()
            );
            $notify->setSubject('New Version CMS Available !');
            $notify->setBody('CMS has a new version, update now!');
            $notify->setUrl(route('admin.update'));
            $notify->send();
            Cache::store('file')->forever($key, $versionAvailable);
        } else {
            Cache::store('file')->put($key, 1, 3600);
        }
    }
}
