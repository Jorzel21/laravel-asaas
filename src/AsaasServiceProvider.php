<?php

namespace Asaas;

use Illuminate\Support\ServiceProvider;

class AsaasServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/asaas.php' => \Illuminate\Support\Facades\App::configPath('asaas.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\PublishAsaasCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/asaas.php', 'asaas');

        // Register the service the package provides.
        $this->app->singleton('asaas', function ($app) {
            return new Asaas;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['asaas'];
    }
}
