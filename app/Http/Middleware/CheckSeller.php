<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSeller
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
        if((Auth::check()) && (Auth::user()->is_seller ==1 && Auth::user()->is_activated ==1)){
            return $next($request);
        }
        else{
            return redirect(route('homepage'))->with('failure', 'you ,ust be logged in to perform action');
        }
    }
}