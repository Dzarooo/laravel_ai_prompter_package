<?php

namespace Dzaro\AIPrompter\providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AIPrompterProvider extends ServiceProvider {
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
            __DIR__.'/../config/aiprompter.php' => config_path('aiprompter.php'),
        ]);
        $this->loadViewsFrom(__DIR__.'/../views', 'views');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}