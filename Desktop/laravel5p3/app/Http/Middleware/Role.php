<?php

namespace App\Http\Middleware;

use App\AccessHandler;
use Closure;

class Role
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
        $user = auth()->user();

        if ( ! AccessHandler::check($user->role, $role)) {

            // return redirect()->route('home')->with('alert', 'No tiene privilegios de admin'); //retorna con mensaje de error
            abort(404);
        }
        return $next($request);
    }
}
