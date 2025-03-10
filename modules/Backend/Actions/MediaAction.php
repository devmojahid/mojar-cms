<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Backend\Actions;

use Juzaweb\CMS\Abstracts\Action;

class MediaAction extends Action
{
    public function handle()
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'addMediaConfigs']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenu']);
    }

    public function addAdminMenu()
    {
        // $this->hookAction->registerAdminPage(
        //     'options-media',
        //     [
        //         'title' => trans('cms::app.media'),
        //         'menu' => [
        //             'icon' => 'fa fa-list',
        //             'position' => 30,
        //             'parent' => 'setting'
        //         ]
        //     ]
        // );
    }

    public function addMediaConfigs()
    {
        $this->hookAction->registerConfig(
            [
                'thumbnail_defaults',
            ]
        );
    }
}
