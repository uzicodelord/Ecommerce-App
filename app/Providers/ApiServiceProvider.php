<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ApiService;

class ApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ApiService::class, function ($app) {
            return new ApiService(config('api.key'));
        });
    }
}
