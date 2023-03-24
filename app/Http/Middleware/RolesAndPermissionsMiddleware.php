<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RolesAndPermissionsMiddleware
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
        $uri = explode('/', $request->getRequestUri());
        if($uri[1] == 'user'){
            if(Auth::user()->hasRole('user')){
                return $next($request);
            }else{
                dd('Você não tem permissão para acessar essa página');
            }
        }
        if($uri[1] == 'dashboard'){
            if(Auth::user()->hasRole('admin')){
                return $next($request);
            }else{
                dd('Você não tem permissão para acessar essa página');
            }
        }
    }
}
