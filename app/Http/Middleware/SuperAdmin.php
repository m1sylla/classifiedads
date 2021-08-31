<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SuperAdmin
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
        if (!Auth::guard('admin')->check()) 
            return redirect()->route('admin.login');
    
        $admin = Auth::guard('admin')->user();

        if ($admin->level != 1) {
            //dd(Auth::guard('admin')->user()->level);
            abort(404);
        }
        return $next($request);
    }
}
