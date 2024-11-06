<?php

namespace Mojar\Backend\Http\Controllers\Backend;

use Mojar\CMS\Http\Controllers\BackendController;

class PermissionController extends BackendController
{
    public function index()
    {
        //

        return view('jupe::index', [
            'title' => 'Title Page',
        ]);
    }
}
