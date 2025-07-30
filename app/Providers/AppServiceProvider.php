<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register admin components
        Blade::componentNamespace('App\\View\\Components\\Admin', 'admin');
    }
}

