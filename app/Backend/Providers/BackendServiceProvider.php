<?php

namespace App\Backend\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'backend');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'backend');
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->register(RouteServiceProvider::class);
    }
    
    /**
     * Register a view file namespace.
     *
     * @param  string  $path
     * @param  string  $namespace
     * @return void
     */
    protected function loadViewsFrom($path, $namespace)
    {
        $this->app['view']->addNamespace('backend', base_path() . '/app/Backend/resources/views');
    }

    /**
     * Register a translation file namespace.
     *
     * @param  string  $path
     * @param  string  $namespace
     * @return void
     */
    protected function loadTranslationsFrom($path, $namespace)
    {
        $this->app['translator']->addNamespace($namespace, $path);
    }
}
