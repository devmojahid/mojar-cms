<?php

namespace Mojahid\Lms\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Juzaweb\Backend\Http\Controllers\Backend\PageController;

class SettingController extends PageController
{
    public function index()
    {
        $title = trans('lms::content.setting');
        return view(
            'lms::backend.setting.index',
            compact(
                'title'
            )
        );

    }
}
