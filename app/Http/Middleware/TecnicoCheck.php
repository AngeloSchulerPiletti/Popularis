<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class TecnicoCheck
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
        if (null !== Auth::user()) {
            if (Auth::user()->tecnico) {
                return $next($request);
            }
            return redirect(RouteServiceProvider::HOME);
        }
        else {
            abort(403);
        }
    }
}
