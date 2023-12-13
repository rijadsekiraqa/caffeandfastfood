<?php


namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the authenticated user has the specified role
        if (auth()->check() && auth()->user()->hasRole(...$roles)) {
            return $next($request);
        }

        abort(403, 'Ju nuk keni akses ne kete dritare');
    }
}


