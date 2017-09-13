<?php

namespace App\Http\Middleware;

use Closure;

use \Auth;

class MustBeOrganizer
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
        $user = $request->user();
        if(Auth::check())
        {
            if($user && $user->level == 1 || $user->level == 2 )
            {

            return $next($request);    

            }    
        }
        

        abort(404, 'Page Not Found');    }
}
