<?php

namespace Antares\Multienv\Providers;

use Dotenv\Dotenv;
use Illuminate\Support\ServiceProvider;

class MultienvServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Dotenv::createImmutable(app()->environmentPath(), '.globals')->safeLoad();
    }
}
