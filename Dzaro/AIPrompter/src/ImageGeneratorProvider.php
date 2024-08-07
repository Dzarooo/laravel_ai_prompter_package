<?php

namespace Dzaro\AIPrompter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ImageGeneratorProvider extends ServiceProvider {
    public function register() {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/imagegenerator.php' => config_path('imagegenerator.php'),
        ]);
        $this->loadViewsFrom(__DIR__.'/views', 'views');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }
}