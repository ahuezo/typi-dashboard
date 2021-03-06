<?php

namespace TypiCMS\Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Dashboard\Repositories\EloquentDashboard;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.dashboard'
        );

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'dashboard');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dashboard');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/dashboard'),
        ], 'views');
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Dashboard\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Dashboard\Composers\SidebarViewComposer');

        $app->bind('Dashboard', EloquentDashboard::class);
    }
}
