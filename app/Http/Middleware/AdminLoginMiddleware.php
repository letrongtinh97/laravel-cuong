<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
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
            if (Auth::user()->level == 0) {
                return Redirect::to('/admin-login')->withErrors('Tài khoản không đủ quyền hạn để vào trang Admin');
            }else{
                return $next($request);
            }  
        }else{
            return Redirect::to('/admin-login')->withErrors('Bạn phải đăng nhập mới truy cập vào trang Admin được');
        }
    }
}
