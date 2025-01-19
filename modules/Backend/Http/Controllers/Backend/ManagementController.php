<?php

namespace Juzaweb\Backend\Http\Controllers\Backend;

use Juzaweb\CMS\Http\Controllers\BackendController;

class ManagementController extends BackendController
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $title = trans('cms::app.managements');

        return view(
            'cms::backend.managements.index',
            compact('title')
        );
    }
}
