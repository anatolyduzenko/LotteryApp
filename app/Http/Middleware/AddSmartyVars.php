<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as FacadesView;

class AddSmartyVars
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
        if (Auth::check()) {
            FacadesView::share('user', Auth::user());
        } else {
            FacadesView::share('guest', 'guest');
        }
        FacadesView::share('csrf_token', csrf_token());
        FacadesView::share('csrf_field', csrf_field());
        return $next($request);
    }
}
