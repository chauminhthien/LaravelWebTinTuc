<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

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
        if(Auth::check()){
            if(Auth::user()->quyen == 1){
                return $next($request);
            }else{
                return redirect('admin/login')->with('loi', 'Bạn Không phải là Admin');
            }
            
        }else{
            return redirect('admin/login');
        }
        
    }
}
