<?php

namespace C1x1\Helpdesk;

use Illuminate\Support\ServiceProvider;

class HelpdeskServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $pkg = 'helpdesk';
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', $pkg);
        $this->loadViewsFrom(__DIR__ . '/resources/view', $pkg);
        $this->mergeConfigFrom(__DIR__ . '/config/helpdesk.php', $pkg);
        $this->publishes([
            __DIR__ . '/config/helpdesk.php' => config_path($pkg),
        ]);
    }

    public function register()
    {

    }
}
