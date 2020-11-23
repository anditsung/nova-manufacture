<?php

namespace Tsung\NovaManufacture;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Tsung\NovaManufacture\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-manufacture');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            $this->registerPolicies();
            Nova::tools($this->registerTools());
        });
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config' => config_path('/'),
        ], 'novamanufacture-config');
    }

    public function registerPolicies()
    {
        Gate::before( function ($user) {
            if ($user->administrator) {
                return true;
            }
        });
    }

    protected function registerTools()
    {
        return [
            new NovaManufacture(),
        ];
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/nova-manufacture')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            //
        ]);
    }
}
