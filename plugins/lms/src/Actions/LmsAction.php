<?php

namespace Mojahid\Lms\Actions;

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Models\Role;

class LmsAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerConfigs']
        );


        $this->addAction(
            Action::FRONTEND_CALL_ACTION,
            [$this, 'registerFrontendAjaxs']
        );

    }



    public function registerConfigs(): void
    {
        HookAction::registerConfig(
            [
                '_checkout_page',
                '_thanks_page',
            ]
        );
    }

    public function registerFrontendAjaxs(): void
    {
        HookAction::registerFrontendAjax(
            'checkout.lms',
            [
                'callback' => [FrontendCheckoutController::class, 'checkout'],
                'method' => 'POST',
            ]
        );
    }

}
