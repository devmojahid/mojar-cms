<?php

namespace Mojar\Backend\Http\Controllers\Backend;

use Illuminate\Contracts\View\View;
use Mojar\CMS\Http\Controllers\BackendController;
use Mojar\Backend\Http\Datatables\EmailLogDatatable;

class EmailLogController extends BackendController
{
    public function index(): View
    {
        $dataTable = new EmailLogDatatable();
        $title = trans('cms::app.email_logs');

        return view(
            'cms::backend.logs.email',
            compact(
                'title',
                'dataTable'
            )
        );
    }
}
