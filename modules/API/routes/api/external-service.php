<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

use Juzaweb\API\Http\Controllers\Auth\LoginController;
use Juzaweb\API\Http\Controllers\Auth\RegisterController;
use Juzaweb\API\Http\Controllers\ThemeController;
use Juzaweb\API\Http\Controllers\PluginController;

Route::get('themes', [ThemeController::class, 'index']);
Route::get('plugins', [PluginController::class, 'index']);
