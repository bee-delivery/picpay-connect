<?php

namespace BeeDelivery\PicPayConnect\Services;

use BeeDelivery\PicPayConnect\PicPay;
use Illuminate\Support\ServiceProvider;

class PicPayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/picpay.php' => config_path('picpay.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/picpay.php', 'picpay');

        // Register the service the package provides.
        $this->app->singleton('picpay', function ($app) {
            return new PicPay;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['picpay'];
    }
}
