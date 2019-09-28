<?php

namespace JonasPardon\KamiCore;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Inertia\Inertia;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'kami');
        Inertia::setRootView('kami::app');
    }
}
