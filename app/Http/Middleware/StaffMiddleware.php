<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class StaffMiddleware
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


      if (Auth::user() &&  Auth::user()->status != 1 && ! DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 2]])->exists()) {
          Auth::logout();
          return back();
          exit();
      }

        return $next($request);
    }
}
