<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web', 'auth', 'role:admin')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web', 'auth', 'role:gerencia')
                ->prefix('gerencia')
                ->group(base_path('routes/gerencia.php'));

            Route::middleware('web', 'auth', 'role:calidad')
                ->prefix('calidad')
                ->group(base_path('routes/calidad.php'));

            Route::middleware('web', 'auth', 'role:campo')
                ->prefix('campo')
                ->group(base_path('routes/campo.php'));

            Route::middleware('web', 'auth', 'role:socializador')
                ->prefix('socializador')
                ->group(base_path('routes/socializador.php'));

            Route::middleware('web', 'auth', 'role:encuestador')
                ->prefix('encuestador')
                ->group(base_path('routes/encuestador.php'));
            
            Route::middleware('web', 'auth', 'role:provincial')
                ->prefix('provincial')
                ->group(base_path('routes/provincial.php'));
            
        });
    }
}
