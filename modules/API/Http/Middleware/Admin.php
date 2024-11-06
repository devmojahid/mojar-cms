<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\API\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Mojar\CMS\Abstracts\Action;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (!$user = Auth::guard('api')->user()) {
            abort(403, __('You can not access this page.'));
        }

        if (!has_permission($user)) {
            abort(403, __('You can not access this page.'));
        }

        do_action(Action::BACKEND_INIT, $request);

        return $next($request);
    }
}
