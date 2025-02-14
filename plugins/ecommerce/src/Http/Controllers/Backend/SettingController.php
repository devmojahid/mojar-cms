<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Juzaweb\Backend\Http\Controllers\Backend\PageController;

class SettingController extends PageController


{
    public function index()
    {
        $title = trans('ecomm::content.setting');
        return view(
            'ecomm::backend.setting.index',
            compact(
                'title'
            )
        );

    }
}
