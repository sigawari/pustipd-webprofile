<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Console\Scheduling\Schedule;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register admin components
        Blade::componentNamespace('App\\View\\Components\\Admin', 'admin');

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('announcements:archive')->everyMinute();
        });
    }
}

