<?php

namespace Mojar\CMS\Http\Middleware;

use Closure;

class GlobalMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
