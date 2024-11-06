<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\CMS\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Mojar\Backend\Http\Resources\UserResource;
use Mojar\CMS\Abstracts\Action;
use Mojar\CMS\Facades\ThemeLoader as ThemeFacade;
use Mojar\CMS\Support\Installer;

class Theme
{
    public function handle($request, Closure $next)
    {
        View::composer(
            '*',
            function ($view) use ($request) {
                global $jw_user;
                $user = $jw_user ? UserResource::make($jw_user)->toArray($request) : null;

                $view->with('user', $user);
                $view->with('is_admin', $user ? $user['is_admin'] : false);
                $view->with('auth', (bool) $user);
                $view->with('guest', !$user);
            }
        );

        if (Installer::alreadyInstalled()) {
            $currentTheme = jw_current_theme();
            $themePath = ThemeFacade::getThemePath($currentTheme);

            if (is_dir($themePath)) {
                ThemeFacade::set($currentTheme);
            }
        }

        do_action(Action::FRONTEND_INIT, $request);

        return $next($request);
    }
}
