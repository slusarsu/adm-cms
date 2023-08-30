<?php

namespace App\Filament\Pages;

use AllowDynamicProperties;
use Creagia\FilamentCodeField\CodeField;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Actions\ActionGroup;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
use Spatie\Valuestore\Valuestore;
use \Illuminate\Contracts\Support\Htmlable;

#[AllowDynamicProperties] class Settings extends Page
{
    protected static ?string $navigationGroup = 'System';
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.settings';

    protected static ?int $navigationSort = 4;

    protected Valuestore $valueStore;

    protected array $parameters;

    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.settings');
    }

    protected function getTitle(): string|Htmlable
    {
        return trans('dashboard.settings');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function __construct($id = null)
    {
        parent::__construct($id);

        if(!self::shouldRegisterNavigation()) {
            abort(404);
        }

        $this->valueStore = siteSetting();

        $this->parameters = [
            'name' => '',
            'author' => '',
            'seoTitle' => '',
            'seoKeyWords' => '',
            'seoDescription' => '',
            'isEnabled' => '',
            'paginationCount' => 10,
            'googleTagManager' => '',
            'metaPixelCode' => '',
            'customHeaderCode' => '',
            'customFooterCode' => '',
            'customCss' => '',
            'logo' => '',
            'footerLogo' => '',
            'email' => '',
            'copyright' => '',
            'isTextLogo' => '',
            'default_language' => '',
            'translation_enabled' => '',
            'values' => '',
        ];
    }

    public function mount(): void
    {
        $this->form->fill($this->prepareParameters());
    }

    protected function prepareParameters(): array
    {
        $parameters = [];

        foreach ($this->parameters as $parameter => $value) {
            $parameters[$parameter] = $this->valueStore->get($parameter);
        }

        return $parameters;
    }

    protected function getFormSchema(): array
    {
        return [
            Tabs::make('Heading')
                ->tabs([
                    Tab::make(trans('dashboard.site_settings'))
                        ->schema([
                            TextInput::make('name')->label(trans('dashboard.name')),

                            FileUpload::make('logo')
                                ->label(trans('dashboard.logo'))
                                ->directory('logo')
                                ->image(),

                            FileUpload::make('footerLogo')
                                ->label(trans('dashboard.footer_logo'))
                                ->directory('logo')
                                ->image(),

                            Toggle::make('isTextLogo')
                                ->label(trans('dashboard.is_text_togo'))
                                ->default(true),

                            TextInput::make('email')
                                ->label(trans('dashboard.email'))
                                ->email(true),

                            TextInput::make('copyright')
                                ->label(trans('dashboard.copyright')),

                            Toggle::make('isEnabled')
                                ->label(trans('dashboard.is_enabled'))
                                ->default(true),
                        ]),
                    Tab::make('SEO')
                        ->schema([
                            TextInput::make('author')
                                ->label(trans('dashboard.author')),

                            TextInput::make('seoTitle')
                                ->label(trans('dashboard.seo_title')),

                            TextInput::make('seoKeyWords')
                                ->label(trans('dashboard.seo_key_words')),

                            Textarea::make('seoDescription')
                                ->label(trans('dashboard.seo_description')),

                            CodeField::make('googleTagManager')
                                ->label(trans('dashboard.google_tag_manager'))
                                ->htmlField()
                                ->withLineNumbers(),

                            CodeField::make('metaPixelCode')
                                ->label(trans('dashboard.meta_pixel_code'))
                                ->htmlField()
                                ->withLineNumbers(),
                        ]),
                    Tab::make(trans('dashboard.content'))
                        ->schema([
                            TextInput::make('paginationCount')
                                ->label(trans('dashboard.pagination_count'))
                                ->integer(true)
                                ->default(9),

                            Select::make('default_language')
                                ->label(trans('dashboard.default_language'))
                                ->options(admLanguages())
                                ->required(),

                            Toggle::make('translation_enabled')
                                ->label(trans('dashboard.translation_enabled'))
                                ->default(true),
                        ]),
                    Tab::make(trans('dashboard.customization'))
                        ->schema([
                            CodeField::make('customHeaderCode')
                                ->label(trans('dashboard.custom_header_code'))
                                ->htmlField()
                                ->withLineNumbers(),
                            CodeField::make('customFooterCode')
                                ->label(trans('dashboard.custom_footer_code'))
                                ->htmlField()
                                ->withLineNumbers(),
                        ]),
                    Tab::make(trans('dashboard.custom_style'))
                        ->schema([
                            CodeField::make('customCss')
                                ->label(trans('dashboard.custom_css'))
                                ->cssField()
                                ->withLineNumbers(),
                        ]),
                    Tab::make(trans('dashboard.custom_settings_values'))
                        ->schema([
                            KeyValue::make('values')
                                ->label(trans('dashboard.custom_values'))
                                ->helperText('add "example_text_key" and "Example text value"')
                        ]),
                ]),
        ];

    }

    public function submit(): void
    {
        $result = $this->form->getState();

        foreach ($result as $field => $value) {
            $this->valueStore->put($field, $value);
        }

        Artisan::call('optimize:clear');

        Notification::make()
            ->title('Saved successfully')
            ->icon('heroicon-o-sparkles')
            ->iconColor('success')
            ->send();
    }

    protected function getActions(): array
    {
        return [

            Action::make('Clear Cache')
                ->label(trans('dashboard.clear_cache'))
                ->action(function () {
                    Artisan::call('optimize:clear');

                    Notification::make()
                        ->title('Fixed!')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->color('success'),

            ActionGroup::make([
                Action::make('Add Demo')
                    ->label(trans('dashboard.add_demo'))
                    ->action(function () {
                        Artisan::call('adm:demo');

                        Notification::make()
                            ->title('Added demo data')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->color('danger'),

                Action::make('Remove Demo')
                    ->label(trans('dashboard.remove_demo'))
                    ->action(function () {
                        Artisan::call('adm:demo-remove');

                        Notification::make()
                            ->title('Removed demo data')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->color('danger'),

                Action::make('Reinstall Demo')
                    ->label(trans('dashboard.reinstall_demo'))
                    ->action(function () {
                        Artisan::call('adm:restart');

                        Notification::make()
                            ->title('Removed all demo')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->color('danger'),
            ])->label('Demo Data')->color('danger'),
        ];
    }

}
