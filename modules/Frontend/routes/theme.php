<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

use Juzaweb\CMS\Support\Route\Auth;

Auth::routes();

if (config('mojar.frontend.enable')) {
    require __DIR__ . '/components/profile.route.php';

    require __DIR__ . '/components/sitemap.route.php';

    require __DIR__ . '/components/feed.route.php';

    require __DIR__ . '/components/page.route.php';
} else {
    Route::get('/', fn() => redirect(config('mojar.admin_prefix')));
}
