<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->isAdmin() )
        {
            return $next($request);
        }

        return redirect('/signup.html');
    }
	
	public function isAdmin() 
	{
		return ($this->permission == 1) ? true : false;
	}
	public function isIdIdentical($id) 
	{
		return ($this->id == $id) ? true : false;
	}
}
