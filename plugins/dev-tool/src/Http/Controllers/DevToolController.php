<?php

namespace Mojarsoft\DevTool\Http\Controllers;

use Juzaweb\CMS\Http\Controllers\BackendController;

class DevToolController extends BackendController
{
    public function index()
    {
        //

        return view(
            'mojarsoft_dev_tool::index',
            [
                'title' => 'Title Page',
            ]
        );
    }
}
