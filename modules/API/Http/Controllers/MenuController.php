<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Juzaweb\API\Http\Controllers;

use Juzaweb\API\Http\Resources\MenuResource;
use Juzaweb\Backend\Repositories\MenuRepository;
use Juzaweb\CMS\Http\Controllers\ApiController;

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
