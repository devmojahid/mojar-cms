<?php

namespace Mojar\Network\Http\Controllers;

use Illuminate\Contracts\View\View;
use Mojar\CMS\Http\Controllers\BackendController;

class ThemeController extends BackendController
{
    public function index(): View
    {
        return view(
            'network::theme.index',
            [
                'title' => trans('cms::app.themes'),
            ]
        );
    }

    public function install(): View
    {
        return view(
            'network::theme.install',
            [
                'title' => trans('cms::app.install'),
            ]
        );
    }
}
