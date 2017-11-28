<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $arUser = Auth::user();
        $username = $arUser['username'];

        if (strpos( $role, $username) === false ) {
            // dd(strpos( $role, $username));
            return redirect('noaccess');
        }
        return $next($request);
    }
}
