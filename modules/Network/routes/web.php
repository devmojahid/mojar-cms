<?php

use Juzaweb\Network\Http\Controllers\SiteController;

Route::get(
    'app/token-login',
    [SiteController::class, 'loginToken']
)->name('network.sites.login-with-token');
