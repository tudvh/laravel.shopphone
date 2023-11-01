<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    private $cus;

    public function __construct()
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = 'cus'): Response
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }

        return redirect()->route('home.login')->with('error', 'Vui lòng đăng nhập');
    }
}
