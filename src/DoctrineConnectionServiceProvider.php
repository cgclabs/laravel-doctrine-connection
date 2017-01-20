<?php
/**
 * Author: Roger Creasy
 * Email: roger@rogercreasy.com
 * Date: 1/20/17
 * Time: 3:01 PM
 */

namespace CGClabs\LaravelDoctrineConnection;

use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application configuration.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/doctrineconnection.php' => config_path('doctrineconnection.php'),
        ]);
    }
    /**
     * Register the service provider.
     */
    public function register()
    {
        $connectionConfig = config('doctrineconnection');

        $this->app->singleton('DoctrineConnection', function($app)
        {
            return new ConnectionConstructor();
        });

    }
}