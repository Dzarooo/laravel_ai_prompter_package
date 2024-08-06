<?php

namespace Dzaro\ImageGenerator;

use Illuminate\Support\ServiceProvider;

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
        $this->loadViewsFrom(__DIR__.'/views', 'test');
    }
}