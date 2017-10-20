<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIdHasCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user() || !is_null($request->user()->company_id)) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
