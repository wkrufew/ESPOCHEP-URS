<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->user()->role === 'admin') {
                    //return redirect()->intended('dashboard');
                    return redirect()->route('admin.dashboard');
                } elseif ($request->user()->role === 'gerencia') {
                    return redirect()->route('gerencia.dashboard');
                }elseif ($request->user()->role === 'calidad') {
                    return redirect()->route('calidad.dashboard');
                }elseif ($request->user()->role === 'campo') {
                    return redirect()->route('campo.dashboard');
                }elseif ($request->user()->role === 'socializador') {
                    return redirect()->route('socializador.dashboard');
                }elseif ($request->user()->role === 'encuestador') {
                    return redirect()->route('encuestador.dashboard');
                }elseif ($request->user()->role === 'user') {
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }

        return $next($request);
    }
}
