<?php

namespace Salyam\Permissions;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['router']->aliasMiddleware('role', \Salyam\Permissions\Middlewares\RoleMiddleware::class);
        $this->app['router']->aliasMiddleware('permission', \Salyam\Permissions\Middlewares\PermissionMiddleware::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/salyam/permissions'),
        ]);

        $this->RegisterBladeDirectives();
    }

    private function RegisterBladeDirectives()
    {
        Blade::if('role',
            function($parameter) {
                if(!is_array($parameter))
                    return Auth::check() && Auth::user()->HasRole($parameter);
                else
                    return Auth::check() && Auth::user()->HasAnyRole($parameter);
            }
        );

        Blade::if('permission',
            function($parameter) {
                if(!is_array($parameter))
                    return Auth::check() && Auth::user()->HasPermission($parameter);
                else
                    return Auth::check() && Auth::user()->HasAnyPermission($parameter);
            }
        );

    }
}
