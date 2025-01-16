<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
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

        if (config('mojar.plugin.enable_upload')) {
            HookAction::addAdminMenu(
                trans('cms::app.dashboard'),
                'dashboard',
                [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>',
                    'position' => 1,
                    'parent' => 'dashboard',
                ]
            );

            HookAction::addAdminMenu(
                trans('cms::app.updates'),
                'updates',
                [
                    'position' => 1,
                    'parent' => 'dashboard',
                ]
            );
        }

        HookAction::addAdminMenu(
            trans('cms::app.media'),
            'media',
            [
                'icon' => 'fa fa-photo',
                'icon_type' => 'font-awesome',
                'position' => 2,
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.appearance'),
            'appearance',
            [
                'icon' => 'fa fa-paint-brush',
                'icon_type' => 'font-awesome',
                'position' => 40,
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.themes'),
            'themes',
            [
                'icon' => 'fa fa-paint-brush',
                'icon_type' => 'font-awesome',
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
                    'icon' => 'fa fa-plus',
                    'icon_type' => 'font-awesome',
                    'position' => 1,
                    'parent' => 'appearance',
                    'permissions' => [
                        'themes.create',
                    ],
                ]
            );

            HookAction::registerAdminPage(
                'theme.editor',
                [
                    'title' => trans('cms::app.editor'),
                    'menu' => [
                        'icon' => 'fa fa-plus',
                        'icon_type' => 'font-awesome',
                        'position' => 99,
                        'parent' => 'appearance',
                        'permissions' => [
                            'themes.edit',
                        ],
                    ]
                ]
            );
        }

        HookAction::addAdminMenu(
            trans('cms::app.widgets'),
            'widgets',
            [
                'icon' => 'fa fa-list',
                'icon_type' => 'font-awesome',
                'position' => 2,
                'parent' => 'appearance',
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.menus'),
            'menus',
            [
                'icon' => 'fa fa-list',
                'icon_type' => 'font-awesome',
                'position' => 2,
                'parent' => 'appearance',
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.setting'),
            'theme.setting',
            [
                'icon' => 'fa fa-cogs',
                'icon_type' => 'font-awesome',
                'position' => 50,
                'parent' => 'appearance',
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.reading'),
            'reading',
            [
                'icon' => 'fa fa-book',
                'icon_type' => 'font-awesome',
                'position' => 10,
                'parent' => 'setting',
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.permalinks'),
            'permalinks',
            [
                'icon' => 'fa fa-link',
                'icon_type' => 'font-awesome',
                'position' => 15,
                'parent' => 'setting',
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.plugins'),
            'plugins',
            [
                'icon' => 'fa fa-plug',
                'icon_type' => 'font-awesome',
                'position' => 50,
            ]
        );

        if (config('mojar.plugin.enable_upload')) {
            HookAction::addAdminMenu(
                trans('cms::app.plugins'),
                'plugins',
                [
                    'icon' => 'fa fa-plug',
                    'icon_type' => 'font-awesome',
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
                    'icon' => 'fa fa-plus',
                    'icon_type' => 'font-awesome',
                    'position' => 1,
                    'parent' => 'plugins',
                    'permissions' => [
                        'plugins.create',
                    ],
                ]
            );

            HookAction::registerAdminPage(
                'plugin.editor',
                [
                    'title' => trans('cms::app.editor'),
                    'menu' => [
                        'icon' => 'fa fa-plus',
                        'icon_type' => 'font-awesome',
                        'position' => 99,
                        'parent' => 'plugins',
                        'permissions' => [
                            'plugins.edit',
                        ],
                    ]
                ]
            );
        }

        HookAction::addAdminMenu(
            trans('cms::app.setting'),
            'setting',
            [
                'icon' => 'fa fa-cogs',
                'icon_type' => 'font-awesome',
                'position' => 70,
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.managements'),
            'managements',
            [
                'icon' => 'fa fa-cogs',
                'icon_type' => 'font-awesome',
                'position' => 75,
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.general_setting'),
            'setting.system',
            [
                'icon' => 'fa fa-cogs',
                'icon_type' => 'font-awesome',
                'position' => 1,
                'parent' => 'setting',
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.users'),
            'users',
            [
                'icon' => 'fa fa-user-circle-o',
                'icon_type' => 'font-awesome',
                'position' => 40,
                'parent' => 'managements',
                'permissions' => [
                    'users.index',
                    'users.edit',
                    'users.create',
                    'users.delete',
                ],
            ]
        );

        HookAction::addAdminMenu(
            trans('cms::app.email_templates'),
            'email-template',
            [
                'icon' => 'fa fa-envelope',
                'icon_type' => 'font-awesome',
                'position' => 50,
                'parent' => 'managements',
                'permissions' => [
                    'email_templates.index',
                    'email_templates.edit',
                    'email_templates.create',
                    'email_templates.delete',
                ],
            ]
        );

        if (!config('network.enable')) {
            HookAction::addAdminMenu(
                trans('cms::app.email_logs'),
                'logs.email',
                [
                    'icon' => 'fa fa-cogs',
                    'icon_type' => 'font-awesome',
                    'position' => 51,
                    'parent' => 'managements',
                ]
            );
        }
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
                'menu_icon' => 'fa fa-edit',
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
