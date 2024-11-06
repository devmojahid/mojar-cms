<?php

namespace Mojar\Backend\Http\Controllers\Installer;

use Mojar\CMS\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        return redirect()->route('installer.welcome');
    }

    public function welcome()
    {
        return view('cms::installer.welcome');
    }
}
