<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\API\Http\Controllers\Admin;

use Mojar\CMS\Abstracts\Action;
use Mojar\CMS\Http\Controllers\ApiController;

class AdminApiController extends ApiController
{
    public function callAction($method, $parameters): \Symfony\Component\HttpFoundation\Response
    {
        do_action(Action::BACKEND_CALL_ACTION, $method, $parameters);

        return parent::callAction($method, $parameters);
    }
}
