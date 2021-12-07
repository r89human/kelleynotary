<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;

class ContractorMiddleware
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

        if (DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 3]])->exists() || DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 4]])->exists()) {
            return $next($request);

        }else{
            return redirect('/');
            
        }

    }
}
