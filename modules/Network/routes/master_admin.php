<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

use Juzaweb\Network\Http\Controllers\MappingDomainController;
use Juzaweb\Network\Http\Controllers\PluginController;
use Juzaweb\Network\Http\Controllers\DashboardController;
use Juzaweb\Network\Http\Controllers\SiteController;
use Juzaweb\Network\Http\Controllers\ThemeController;

Route::get('/', [DashboardController::class, 'index'])->name('admin.network.dashboard');

Route::post('sites/{id}/add-mapping-domain', [MappingDomainController::class, 'store'])
    ->name('network.mapping-domains.store');
Route::delete('sites/{site_id}/{id}/destroy', [MappingDomainController::class, 'destroy'])
    ->name('network.mapping-domains.destroy');
Route::jwResource('sites', SiteController::class, ['name' => 'network.sites']);

Route::jwResource('themes', ThemeController::class, ['name' => 'network.themes']);
Route::get('theme/install', [ThemeController::class, 'install'])->name('admin.network.theme.install');

Route::jwResource('plugins', PluginController::class, ['name' => 'network.plugins']);
Route::get('plugin/install', [PluginController::class, 'install'])->name('admin.network.plugin.install');
