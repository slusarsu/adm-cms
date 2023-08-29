<?php

namespace App\Providers;

use App\Adm\Services\CustomFieldService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        CustomFieldService::setCustomFields('demo', [
            TextInput::make('custom_fields.author')
                ->label(trans('dashboard.author'))
                ->columnSpan('full'),

            TextInput::make('custom_fields.title')
                ->label(trans('dashboard.title'))
                ->columnSpan('full'),
        ]);


        CustomFieldService::setCustomFields('text', [
            Textarea::make('custom_fields.description')
                ->label(trans('dashboard.description'))
                ->columnSpan('full'),

            FileUpload::make('custom_fields.thumb')
                ->label(trans('dashboard.thumb'))
                ->directory('images')->image(),
        ]);
    }
}
