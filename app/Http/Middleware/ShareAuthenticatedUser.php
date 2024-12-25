<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareAuthenticatedUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            View::share('user', Auth::user());
        }

        return $next($request);
    }
}