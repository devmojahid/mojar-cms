<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/juzacms
 * @author     The Anh Dang
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Mojar\DevTool\Actions;

use Mojar\CMS\Abstracts\Action;

class MenuAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenus']);
    }

    public function addAdminMenus(): void
    {
        $this->hookAction->addAdminMenu(
            'Dev Tools',
            'dev-tools',
            [
                'parent' => 'tools',
            ]
        );
    }
}
