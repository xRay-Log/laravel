<?php

namespace xRayLaravel;

use Illuminate\Support\ServiceProvider;
use xRayLaravel\Facades\xRay;
use xRayLog\xRayLogger;

class xRayLoggerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(xRayLogger::class, function ($app) {
            return new xRayLogger($app['config']['app.name'] ?? 'Laravel');
        });

        $this->app->singleton('xRay', function ($app) {
            return new xRayHandler($app->make(xRayLogger::class));
        });

        if ($this->app['config']['app.env'] !== 'testing') {
            $this->app->booting(function ($app) {
                xray_setup([
                    "project" => $app->config['app.name'] ?? 'Laravel'
                ]);
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('xRay', xRay::class);
            });
        }
    }
}
