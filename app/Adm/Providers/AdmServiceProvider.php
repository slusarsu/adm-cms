<?php

namespace App\Adm\Providers;

use Filament\Facades\Filament;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdmServiceProvider extends ServiceProvider
{
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
        $this->loadViewsFrom(__DIR__.'/../Resources', 'adm');
        $site = siteSettingsAll();
        View::share('site', $site);
        Paginator::useBootstrap();
        Filament::serving(function () {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');

            Filament::registerNavigationGroups([
                'Content',
                'Tools',
                'Authentication',
                'System',
            ]);

        });

    }
}
