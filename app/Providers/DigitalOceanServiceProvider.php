<?php

namespace App\Providers;

use App\Services\FileStorageService\SpaceStorageService;
use App\Services\FileStorageService\FileStorageService;
use Illuminate\Support\ServiceProvider;

class DigitalOceanServiceProvider extends ServiceProvider
{
    public $bindings = [
        FileStorageService::class => SpaceStorageService::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
