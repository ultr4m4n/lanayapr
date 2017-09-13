<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;
class MustAuth
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
        if(Auth::check() && Auth::user()->id === $request->get('id'))
        {
          return $next($request);  
        }
        abort(404, 'Page Not Found');
        
    }
}
