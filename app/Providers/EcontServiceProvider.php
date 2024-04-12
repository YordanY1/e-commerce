<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\EcontService;

class EcontServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EcontService::class, function ($app) {
            return new EcontService();
        });
    }

    public function boot()
    {
        //
    }
}
