<?php

namespace Mojarsoft\DevTool\Actions;

use Juzaweb\CMS\Abstracts\Action;

class DevToolAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle(): void
    {
        // $this->addAction(Action::INIT_ACTION, [$this, 'registerPostTypes']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenu']);
    }

    public function registerPostTypes()
    {
        $this->hookAction->registerPostType(
            'dev_tool_theme',
            [
                'label' => __('Dev Tool Theme'),
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.482 20.924a1.666 1.666 0 0 1 -1.157 -1.241a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.312 .318 1.644 1.794 .995 2.697" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg>',
                'metas' => [
                    'theme_name' => [

                        'type' => 'text',
                        'label' => __('Theme Name')
                    ],
                    'theme_version' => [
                        'type' => 'text',
                        'label' => __('Theme Version')
                    ],
                    'theme_author' => [
                        'type' => 'text',
                        'label' => __('Theme Author')
                    ],
                ],
            ]
        );

        $this->hookAction->registerPostType(
            'dev_tool_plugin',
            [
                'label' => __('Dev Tool Plugin'),
                'menu_icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.482 20.924a1.666 1.666 0 0 1 -1.157 -1.241a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.312 .318 1.644 1.794 .995 2.697" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg>',
                'metas' => [
                    'plugin_name' => [
                        'type' => 'text',
                        'label' => __('Plugin Name')
                    ],
                    'plugin_version' => [
                        'type' => 'text',
                        'label' => __('Plugin Version')
                    ],
                    'plugin_author' => [
                        'type' => 'text',
                        'label' => __('Plugin Author')
                    ],
                ],
            ]
        );
    }
    
    public function addAdminMenu(): void
    {
        $this->hookAction->addAdminMenu(
            'dev_tool',
            'dev_tool',
            [
                'title' => __('Dev Tool'),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-tool"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" /></svg>',
                'position' => 30,
            ]
        );
        
        $this->hookAction->addAdminMenu(
            'cms_versions',
            'dev-tool.cms-versions',
            [
                'title' => __('CMS Versions'),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-version"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M6 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M5 12h14" /><path d="M13 19l4 -4l-4 -4" /></svg>',
                'parent' => 'dev_tool',
                'position' => 1
            ]
        );
        
        $this->hookAction->addAdminMenu(
            'package_versions',
            'dev-tool.package-versions',
            [
                'title' => __('Package Versions'),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>',
                'parent' => 'dev_tool',
                'position' => 2,
            ]
        );
    }
}

