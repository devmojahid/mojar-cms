<?php

namespace Mojar\Backend\Http\Controllers\Backend;

use Mojar\CMS\Http\Controllers\BackendController;

class ToolController extends BackendController
{
    public function index()
    {
        //

        return view(
            'juto::index',
            [
                'title' => 'Title Page',
            ]
        );
    }
}
