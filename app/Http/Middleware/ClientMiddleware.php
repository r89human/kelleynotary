<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class ClientMiddleware
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

        if (! DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 1]])->exists()  ) {
            return redirect('/');
        }

        return $next($request);
    }
}
