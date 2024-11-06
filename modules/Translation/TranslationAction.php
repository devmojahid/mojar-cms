<?php

namespace Mojar\Translation;

use Mojar\CMS\Abstracts\Action;
use Mojar\CMS\Facades\HookAction;

class TranslationAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::BACKEND_INIT, [$this, 'addBackendMenu']);
    }

    public function addBackendMenu(): void
    {
        HookAction::registerAdminPage(
            'translations',
            [
                'title' => trans('cms::app.translations'),
                'menu' => [
                    'icon' => 'fa fa-language',
                    'position' => 90,
                    'parent' => 'tools',
                ],
            ]
        );
    }
}
