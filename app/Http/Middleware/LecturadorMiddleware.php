<?php

namespace sisOTB\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
class LecturadorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
      if (Auth::check() && Auth::user()->idRol==$role) {
        // code...
        if (Auth::user()->estado=='Habilitado') {

          return $next($request);
        }
        else{

          return  Redirect::to('/logout');
        }
        }
    return Redirect::to('/error');
    }
}
