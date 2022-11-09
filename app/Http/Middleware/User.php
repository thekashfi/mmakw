<?php

namespace App\Http\Middleware;

use Closure;

class User
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
 
		if(auth('webs')->user()){
            return $next($request);
        }
        return redirect('/login')->with('error','You have not admin access');
    }
}
