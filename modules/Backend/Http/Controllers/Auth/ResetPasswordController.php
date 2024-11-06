<?php

namespace Mojar\Backend\Http\Controllers\Auth;

use Mojar\CMS\Http\Controllers\Controller;
use Mojar\CMS\Traits\Auth\AuthResetPassword;

class ResetPasswordController extends Controller
{
    use AuthResetPassword;
}
