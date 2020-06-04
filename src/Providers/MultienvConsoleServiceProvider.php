<?php

namespace Antares\Multienv\Providers;

use Illuminate\Support\ServiceProvider;

class MultienvConsoleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            \Antares\Multienv\Console\SetupCommand::class,
        ]);
    }
}
