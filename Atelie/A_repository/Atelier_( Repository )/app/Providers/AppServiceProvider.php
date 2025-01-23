<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ProductRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ProductRepository::class, function ($app) {
            return new ProductRepository();
        });
    }

    public function boot()
    {
        //
    }
}

