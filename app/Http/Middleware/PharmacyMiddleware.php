<?php

namespace App\Http\Middleware;

use Closure;
use App\Employee;
use Auth;

class PharmacyMiddleware
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
        if ( ! Auth::guard('pharmacy')->check() )
            return redirect(route('pharmacy.get.login'));

        return $next($request);
    }
}
