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

        $adminMenu = [
            'Content',
            'Tools',
            'Authentication',
            'System',
        ];

        if(siteSetting()->get('shopEnabled')) {
            $adminMenu[] = 'shop';
        }

        Filament::serving(function () use ($adminMenu) {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');

            Filament::registerNavigationGroups($adminMenu);

        });

    }
}
