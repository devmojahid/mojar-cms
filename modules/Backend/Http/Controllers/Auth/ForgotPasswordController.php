<?php

namespace Mojar\Backend\Http\Controllers\Auth;

use Mojar\CMS\Http\Controllers\Controller;
use Mojar\CMS\Traits\Auth\AuthForgotPassword;

class ForgotPasswordController extends Controller
{
    use AuthForgotPassword;
}
