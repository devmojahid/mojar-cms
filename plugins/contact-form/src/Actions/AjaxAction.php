<?php

namespace Mojahid\ContactForm\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Mojahid\ContactForm\Http\Controllers\Frontend\ContactController;
use Juzaweb\CMS\Facades\HookAction;
class AjaxAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerPostContact']);
    }

    public function registerPostContact(): void
    {
        HookAction::registerFrontendAjax(
            'contact',
            [
                'method' => 'POST',
                'callback' => [ContactController::class, 'store'],
            ]
        );
    }
}
