<?php

namespace Pbmengine\Video;

use Illuminate\Support\ServiceProvider;

class VideoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('pbm-video-api.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'pbm-video');

        $this->app->singleton(Video::class, function ($app) {
            return new Video(
                $app['config']['pbm-video']['base_path'],
                $app['config']['pbm-video']['api_key'],
                $app['config']['pbm-video']['access_key'],
                $app['config']['pbm-video']['secret_key']
            );
        });
    }
}
