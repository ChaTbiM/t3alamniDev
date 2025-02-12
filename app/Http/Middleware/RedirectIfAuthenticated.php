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
        // if (Auth::guard('admin')->check()) {
        //     return redirect()->route('admin');
        // }
        //  if (Auth::guard('teacher')->check()){
        //     return redirect()->route('teacher');
        // }
        // if (Auth::guard('student')->check()){
        //     return redirect()->route('student');
        // }
        //  if(Auth::guard($guard)->check()){

        //      return redirect()->route('home');
        //  }
            
        switch ($guard){
            case 'admin':
                if(Auth::guard($guard)->check()){

                    return redirect()->route('admin');
                }
                break;
            case 'teacher':
                if(Auth::guard($guard)->check()){
                        
                    return redirect()->route('teacher');
                }
                break;
            case 'student':
                if(Auth::guard($guard)->check()){
                        
                    return redirect()->route('student');
                }
                break;
            default:
                if(Auth::guard($guard)->check()){
                        
                    return redirect()->route('home');
                }
                break;
        }

        // if(Auth::guard($guard)->check()){
        //     return redirect()->route('home');
        // }

        return $next($request);
    }
}
