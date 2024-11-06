<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package mojar/cms
 * @author The Anh Dang
 *
 * Developed based on Laravel Framework
 * Github: https://mojar.com/cms
 */

namespace Mojar\CMS\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
}
