<?php

namespace Mojarsoft\DevTool\Actions;

use Illuminate\Support\Facades\Route;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;

class DevToolAction extends Action
{
    /**
     * Handle the action.
     *
     * @return void
     */
    public function handle()
    {
        // $this->addAction(Action::INIT_ACTION, [$this, 'registerPostTypes']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenu']);
    }

    public function registerPostTypes()
    {
        HookAction::registerPostType('dev_tool_theme', [
            'label' => trans('dev-tool::content.theme'),
            'model' => \Mojarsoft\DevTool\Models\CmsTheme::class,
            'menu_position' => 99,
            'menu_icon' => 'fa fa-paint-brush',
            'supports' => ['title', 'custom_fields'],
        ]);

        HookAction::registerPostType('dev_tool_plugin', [
            'label' => trans('dev-tool::content.plugin'),
            'model' => \Mojarsoft\DevTool\Models\CmsPlugin::class,
            'menu_position' => 99,
            'menu_icon' => 'fa fa-plug',
            'supports' => ['title', 'custom_fields'],
        ]);
    }

    public function addAdminMenu()
    {
        HookAction::addAdminMenu(
            trans('dev-tool::content.dev_tool'),
            'dev-tool',
            [
                'icon' => 'fa fa-code',
                'position' => 30,
            ]
        );

        HookAction::addAdminMenu(
            trans('dev-tool::content.cms_versions'),
            'dev-tool.cms-versions',
            [
                'icon' => 'fa fa-server',
                'position' => 1,
                'parent' => 'dev-tool',
            ]
        );

        HookAction::addAdminMenu(
            trans('dev-tool::content.package_versions'),
            'dev-tool.package-versions',
            [
                'icon' => 'fa fa-box',
                'position' => 2,
                'parent' => 'dev-tool',
            ]
        );
        
        // Add marketplace menus
        HookAction::addAdminMenu(
            trans('dev-tool::content.marketplace'),
            'dev-tool.marketplace',
            [
                'icon' => 'fa fa-shopping-cart',
                'position' => 3,
                'parent' => 'dev-tool',
            ]
        );
        
        HookAction::addAdminMenu(
            trans('dev-tool::content.themes'),
            'dev-tool.marketplace-themes',
            [
                'icon' => 'fa fa-paint-brush',
                'position' => 4,
                'parent' => 'dev-tool',
            ]
        );
        
        HookAction::addAdminMenu(
            trans('dev-tool::content.plugins'),
            'dev-tool.marketplace-plugins',
            [
                'icon' => 'fa fa-plug',
                'position' => 5,
                'parent' => 'dev-tool',
            ]
        );
    }
}

