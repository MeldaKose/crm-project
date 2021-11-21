<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        $role=Auth::user()->role_id;
        if($role==1){
            return $next($request);
        }
        else{
            return response()->json(['message','Yetkisiz Giriş'],401);
        }
    }
}
