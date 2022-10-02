<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\LocationService;

class LocationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LocationService::class, function ()
        {
            return new LocationService();
        });
    }
}