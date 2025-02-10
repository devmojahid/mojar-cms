<?php

namespace Mojahid\EventManagement\Http\Controllers;

use Juzaweb\CMS\Http\Controllers\BackendController;

class EventManagementController extends BackendController
{
    public function index()
    {
        //

        return view(
            'mojahid_event_management::index',
            [
                'title' => 'Title Page',
            ]
        );
    }
}
