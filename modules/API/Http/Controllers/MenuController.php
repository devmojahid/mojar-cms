<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Mojar\API\Http\Controllers;

use Mojar\API\Http\Resources\MenuResource;
use Mojar\Backend\Repositories\MenuRepository;
use Mojar\CMS\Http\Controllers\ApiController;

class MenuController extends ApiController
{
    public function __construct(protected MenuRepository $menuRepository) {}

    public function show(string $location): MenuResource
    {
        $menu = $this->menuRepository->getFrontendDetailByLocation($location);

        abort_if($menu === null, 404);

        return MenuResource::make($menu);
    }
}
