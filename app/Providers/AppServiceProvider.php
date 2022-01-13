<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
      $this->app->singleton(Settings::class, function () {
        return Settings::firstOrFail();
      });
    }
}
