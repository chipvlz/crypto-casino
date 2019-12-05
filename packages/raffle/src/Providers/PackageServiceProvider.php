<?php

namespace Packages\Raffle\Providers;

use Illuminate\Support\ServiceProvider;
use Packages\Raffle\Console\Commands\GenerateRaffleTickets;
use Packages\Raffle\Console\Commands\ProcessRaffle;
use Illuminate\Console\Scheduling\Schedule;


class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $packageBaseDir = __DIR__ . '/../../';
        // load migrations
        $this->loadMigrationsFrom($packageBaseDir . 'database/migrations');
        // load routes
        $this->loadRoutesFrom($packageBaseDir . 'routes/web.php');
        // load views fom current package
        $this->loadViewsFrom($packageBaseDir . 'resources/views', 'raffle');
        // register commands and schedules
        if ($this->app->runningInConsole()) {
            $this->commands([
                ProcessRaffle::class,
                GenerateRaffleTickets::class
            ]);

            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);
                $schedule->command('process:raffle')->everyMinute();
                $schedule->command('generate:tickets')->cron('*/' . config('settings.bots.raffle.frequency') . ' * * * *');
            });
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $packageBaseDir = __DIR__ . '/../../';
        // load package config
        $this->mergeConfigFrom(
            $packageBaseDir . 'config/config.php', 'raffle'
        );

        // register package event service provider
        $this->app->register(EventServiceProvider::class);
    }
}
