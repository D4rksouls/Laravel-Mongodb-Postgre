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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
            ->prefix('sedes')
            ->group(base_path('routes/Postgre/Sedes.routes.php'));

            Route::middleware('api')
            ->prefix('areas')
            ->group(base_path('routes/Postgre/Areas.routes.php'));

            Route::middleware('api')
            ->prefix('ciudades')
            ->group(base_path('routes/Postgre/ciudades.routes.php'));

            Route::middleware('api')
            ->prefix('contrataciones')
            ->group(base_path('routes/Postgre/Contratacion.routes.php'));

            Route::middleware('api')
            ->prefix('departamentos')
            ->group(base_path('routes/Postgre/Departamentos.routes.php'));

            Route::middleware('api')
            ->prefix('empleados')
            ->group(base_path('routes/Postgre/Empleados.routes.php'));

            Route::middleware('api')
            ->prefix('facultades')
            ->group(base_path('routes/Postgre/Facultades.routes.php'));

            Route::middleware('api')
            ->prefix('paises')
            ->group(base_path('routes/Postgre/Paises.routes.php'));

            Route::middleware('api')
            ->prefix('programas')
            ->group(base_path('routes/Postgre/Programas.routes.php'));

            Route::middleware('api')
            ->prefix('tipoEmpleados')
            ->group(base_path('routes/Postgre/TipoEmpleados.routes.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
