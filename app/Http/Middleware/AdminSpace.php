<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminSpace
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() != null && $request->user()->role == 'ADMIN') {
            return $next($request);
        }
        return abort(403);
    }
}
