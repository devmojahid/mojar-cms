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

use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;

class SocialLoginAction extends Action
{
    public function handle()
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'addSettingForm']
        );
    }

    public function addSettingForm()
    {
        $socials = [
            'facebook',
            'google',
            'twitter',
            'linkedin',
            'github',
        ];

        HookAction::registerConfig([
            'auth_layout' => [
                'type' => 'select',
                'label' => trans('cms::app.auth_layout'),
                'data' => [
                    'default' => 'default',
                ],
            ],
        ]);

        $data = get_config('socialites', []);
        $authLayouts = [
            'default' => trans('cms::app.default'),
            'with_illustration' => trans('cms::app.with_illustration'),
            'with_cover' => trans('cms::app.with_cover'),
        ];

        HookAction::addSettingForm(
            'social-login',
            [
                'name' => trans('cms::app.social_login'),
                'view' => view(
                    'cms::backend.setting.system.form.social_login',
                    compact('socials', 'data', 'authLayouts')
                ),
                'priority' => 40
            ]
        );
    }
}
