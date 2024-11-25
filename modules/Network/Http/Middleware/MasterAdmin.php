<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Network\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Juzaweb\CMS\Abstracts\Action;

class MasterAdmin
{
    public function handle($request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route(
                'admin.login',
                [
                    'redirect' => url()->current()
                ]
            );
        }

        $user = Auth::user();

        if (! $user->isMasterAdmin()) {
            abort(404);
        }

        config()->set('mojar.plugin.enable_upload', true);
        config()->set('mojar.theme.enable_upload', true);

        do_action(Action::NETWORK_INIT, $request);

        return $next($request);
    }
}
