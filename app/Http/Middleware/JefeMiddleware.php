<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JefeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $actualUser = $request->user();
        if($actualUser == null) {
            return redirect('login');
        }
        if($actualUser->puesto != 'jefe') {
            return redirect('/almacen');
        }
        return $next($request);
    }
}
