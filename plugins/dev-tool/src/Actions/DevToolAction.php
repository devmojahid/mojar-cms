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
        $this->addAction(Action::INIT_ACTION, [$this, 'registerPostTypes']);
    }

    public function registerPostTypes()
    {
        $this->hookAction->registerPostType(
            'theme',
            [
                'label' => __('Theme'),
                'menu_icon' => 'fa fa-list',
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
    }
}
