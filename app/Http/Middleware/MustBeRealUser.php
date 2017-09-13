<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;
class MustBeRealUser
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
        $id=$request->route()->parameters();
        $user = $request->user();
        if(Auth::check())
        {        
            if($user && Auth::user()->id === $id)
            {

            return $next($request);    

            }
        }  
        abort(404, 'Page not found');
    }
}
