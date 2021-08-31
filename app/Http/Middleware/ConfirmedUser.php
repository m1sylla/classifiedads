<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;

class ConfirmedUser
{
    protected $guard;

    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //confirmed.user
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) 
            return redirect()->route('login');
    
        $user = Auth::user();
        
        if (!$user->confirmed)
        {
            Session::flash('user_not_confirmed', "Vous devez confirmer votre email.");
            // confirm link
            return redirect()->route('profile');
        }
        else
        {
            return $next($request);
        }
    }
}
