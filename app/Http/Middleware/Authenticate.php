<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->session()->has('user') && $request->session()->has('token_key')) {

            if (!(strtotime(date('Y-m-d H:i:s')) >= strtotime($request->session()->get('expires_at')))) {

                return $next($request);
            }
        }
        return  redirect()->guest('/login');
    }
}
