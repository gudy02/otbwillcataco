<?php

namespace sisOTB\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class AdminMiddleware
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
        if (Auth::check() && Auth::user()->idRol==1 ) {
          // code...

          if (Auth::user()->estado=='Habilitado') {

            return $next($request);
          }
          else{

            return  Redirect::to('/logout');
          }
      }
      return Redirect::to('error');
    }
}
