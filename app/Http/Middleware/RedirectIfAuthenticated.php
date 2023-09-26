<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        // 一般ユーザの場合
        if (Auth::guard('user')->check()) {
            return redirect('/home');
             
        // 管理ユーザの場合
        } elseif (Auth::guard('admin')->check()) {
            return redirect('/admin/order');
        }

        return $next($request);
    }
}
