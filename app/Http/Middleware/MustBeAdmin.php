<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;
class MustBeAdmin
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
            if($user && $user->level == 2)
            {

            return $next($request);    

            }
        }    
        abort(404, 'Page not found');
        
    }
}
