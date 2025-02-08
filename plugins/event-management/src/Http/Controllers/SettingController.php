<?php

namespace Mojahid\EventManagement\Http\Controllers;

use Juzaweb\Backend\Http\Controllers\Backend\PageController;

class SettingController extends PageController

{
    public function index()
    {
        $title = trans('evman::content.setting');


        return view(
            'evman::backend.setting.index',
            compact(
                'title'
            )
        );

    }
}
