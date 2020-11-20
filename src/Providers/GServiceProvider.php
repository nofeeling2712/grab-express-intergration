<?php


namespace GExpress\GService\Providers;

use Illuminate\Support\ServiceProvider;

class GServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->publishes([
            __DIR__ . '/../config/gservice.php' => config_path('gservice.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/gservice.php', 'gservice');
    }
}
