<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\Backend\Actions;

use Mojar\CMS\Abstracts\Action;
use Mojar\CMS\Facades\HookAction;

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

        $data = get_config('socialites', []);

        HookAction::addSettingForm(
            'social-login',
            [
                'name' => trans('cms::app.social_login'),
                'view' => view(
                    'cms::backend.setting.system.form.social_login',
                    compact('socials', 'data')
                ),
                'priority' => 40
            ]
        );
    }
}
