<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Network\Http\Controllers;

use Illuminate\Contracts\View\View;
use Mojar\CMS\Http\Controllers\BackendController;

class DashboardController extends BackendController
{
    public function index(): View
    {
        $title = trans('cms::app.dashboard');

        return view('network::dashboard', compact('title'));
    }
}
