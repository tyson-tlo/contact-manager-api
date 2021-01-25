<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyBelongsToAuthenticatedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->route('company') || $request->route('company')->user_id !== $request->user()->id) {
            return abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
