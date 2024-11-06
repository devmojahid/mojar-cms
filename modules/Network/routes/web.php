<?php

use Mojar\Network\Http\Controllers\SiteController;

Route::get(
    'admin-cp/token-login',
    [SiteController::class, 'loginToken']
)->name('network.sites.login-with-token');
