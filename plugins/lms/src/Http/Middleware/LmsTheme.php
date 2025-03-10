<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Lms\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class LmsTheme
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
