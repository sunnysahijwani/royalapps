<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //connecting the Author and Boosk Interface with respective Service file.
        $this->app->bind(

            'App\Interfaces\AuthorInterface',
            'App\Services\AuthorServices'
        );
        $this->app->bind(

            'App\Interfaces\BookInterface',
            'App\Services\BooksServices'
        );
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
