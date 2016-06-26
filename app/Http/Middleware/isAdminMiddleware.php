<?php

namespace CodeCommerce\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdminMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (Auth::check()) {
            if(Auth::user()->is_admin == 1) {
                return $next($request);
            } else {
                return redirect()->guest('login');
            }
        } else {
            return redirect()->guest('login');
        }
    }

}
