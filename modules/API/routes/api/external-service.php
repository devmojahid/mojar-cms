<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

use Juzaweb\API\Http\Controllers\Auth\LoginController;
use Juzaweb\API\Http\Controllers\Auth\RegisterController;

Route::get('themes', function () {
    return response()->json(['message' => 'Hello World']);
});
