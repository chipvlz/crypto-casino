<?php

namespace App\Providers;

use App\Helpers\PackageManager;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $packageManager;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.force_ssl')) {
            \URL::forceScheme('https');
        }

        // share app settings with all views
        View::share('settings', (object)config('settings'));

        // log DB queries
        DB::listen(function ($query) {
            Log::debug($query->sql, ['params' => $query->bindings, 'time' => $query->time]);
        });

        // custom Blade components
        Blade::component('components.session.messages', 'message');
        Blade::component('components.tables.search', 'search');

        // @admin() blade directive
        Blade::if('admin', function () {
            return auth()->user() && auth()->user()->admin();
        });

        // @installed() blade directive
        Blade::if('installed', function ($packageId) {
            // package is installed and enabled
            return $this->packageManager->installed($packageId) && $this->packageManager->enabled($packageId);
        });

        // @packageview() blade directive to load package views
        Blade::directive('packageview', function ($view) {
            $view = str_replace('\'', '', $view); // remove single quotes from the beginning and the end
            $expression = '';

            // loop through installed packages and check if they implement given view name
            foreach ($this->packageManager->getEnabled() as $package) {
                if (view()->exists($package->id . '::' . $view)) {
                    $expression .= 'echo $__env->make("' . $package->id . '::' . $view . '", array_except(get_defined_vars(), array("__data", "__path")))->render();';
                }
            }

            return $expression ? '<?php ' . $expression . '?>' : '';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // PackageManager() instance can not be bound using $this->app->singleton(),
        // because package config needs to be properly loaded first, which happens only after registering the package service provider
        $this->packageManager = new PackageManager();

        // if any extra packages are installed
        if (count($this->packageManager->getEnabled())) {
            // auto load package classes
            spl_autoload_register([$this->packageManager, 'autoload']);

            // register package service providers
            foreach ($this->packageManager->getEnabled() as $package) {
                foreach ($package->providers as $provider) {
                    $this->app->register($provider);
                }
            }
        }
    }
}
