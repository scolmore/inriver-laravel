<?php

declare(strict_types=1);

namespace Scolmore\InRiver;

use Illuminate\Support\ServiceProvider;

class InRiverServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/inriver.php', 'inriver');

        $this->app->singleton('inriver', function ($app) {
            return new InRiver;
        });
    }

    public function provides(): array
    {
        return ['inriver'];
    }

    protected function bootForConsole(): void
    {
        $this->publishes([
            __DIR__.'/../config/inriver.php' => config_path('inriver.php'),
        ], 'inriver.config');
    }
}
