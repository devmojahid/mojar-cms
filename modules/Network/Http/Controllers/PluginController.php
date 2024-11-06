<?php

namespace Mojar\Network\Http\Controllers;

use Illuminate\Contracts\View\View;
use Mojar\CMS\Http\Controllers\BackendController;

class PluginController extends BackendController
{
    public function index(): View
    {
        return view(
            'network::plugin.index',
            [
                'title' => trans('cms::app.plugins'),
            ]
        );
    }

    public function install(): View
    {
        if (!config('mojar.plugin.enable_upload')) {
            abort(403, 'Access deny.');
        }

        $this->addBreadcrumb(
            [
                'url' => route('admin.plugin'),
                'title' => trans('cms::app.plugins')
            ]
        );

        $title = trans('cms::app.install');

        return view(
            'network::plugin.install',
            compact('title')
        );
    }
}
