<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Juzaweb\API\Http\Middleware;

class SwaggerApiDocumentation
{
    public function handle($request, \Closure $next)
    {
        if (!config('mojar.api.enable')) {
            abort(404);
        }

        return $next($request);
    }
}
