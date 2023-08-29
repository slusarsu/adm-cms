<?php

namespace App\Filament\Pages;

use AllowDynamicProperties;
use App\Adm\Services\TranslationService;
use Creagia\FilamentCodeField\CodeField;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Actions\ActionGroup;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use SebastiaanKloos\FilamentCodeEditor\Components\CodeEditor;

#[AllowDynamicProperties] class Translations extends Page
{
    protected static ?string $navigationGroup = 'System';
    protected static ?string $navigationIcon = 'heroicon-o-translate';

    protected static string $view = 'filament.pages.translations';
    protected static ?int $navigationSort = 1;

    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.translations');
    }

    protected function getTitle(): string|Htmlable
    {
        return trans('dashboard.translations');
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

        $this->translationFolders = TranslationService::getTranslationFolders();
        $this->folder = '';
        $this->file = '';
        $this->code = '';
    }

    public function mount(): void
    {

    }

    protected function getFormSchema(): array
    {
        return [

            Card::make()->schema([
                Select::make('folder')
                    ->label(trans('dashboard.folder'))
                    ->options($this->translationFolders)
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('file', null))
                    ->searchable(),

                Select::make('file')
                    ->label(trans('dashboard.file'))
                    ->options(function(callable $get) {
                        return TranslationService::getTranslationFilesFromFolder($get('folder'));
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set, callable $get) => $set('code', TranslationService::getTranslationArray($get('file'))))
                    ->searchable(),

                KeyValue::make('code')
                    ->label(trans('dashboard.code'))
                    ->helperText('add "example_text_key" and "Example text value"')
            ])
        ];

    }

    public function submit(): void
    {
        $result = $this->form->getLivewire()->validate();

        TranslationService::saveTranslationsArrayToFile($result['code'],$result['file']);

        Notification::make()->title('Saved successfully')->success()->send();
    }

    protected function getActions(): array
    {
        return [

            Action::make('Create File')
                ->label(trans('dashboard.create_file'))
                ->action(function (array $data): void {
                    TranslationService::createEmptyTranslationFile($data['folder'], $data['file_name']);
                    Notification::make()->title('Saved successfully')->success()->send();
                })
                ->form([
                    Select::make('folder')
                        ->label(trans('dashboard.folder'))
                        ->options($this->translationFolders)
                        ->required()
                        ->searchable(),

                    TextInput::make('file_name')
                        ->label(trans('dashboard.file_name'))
                        ->helperText('File name should be like "products" or in snake case like "main_products"'),
                ]),


            Action::make('Copy File')
                ->label(trans('dashboard.copy_file'))
                ->action(function (array $data): void {
                    TranslationService::copyTranslationFile($data);
                    Notification::make()->title('Saved successfully')->success()->send();
                })
                ->form([
                    Select::make('copy_from_folder')
                        ->label(trans('dashboard.copy_from_folder'))
                        ->options($this->translationFolders)
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn (callable $set) => $set('copy_from_file', null))
                        ->searchable(),

                    Select::make('copy_from_file')
                        ->label(trans('dashboard.copy_from_file'))
                        ->options(function(callable $get) {
                            return TranslationService::getTranslationFilesFromFolder($get('copy_from_folder'));
                        })
                        ->required()
                        ->searchable(),

                    Select::make('copy_to_folder')
                        ->label(trans('dashboard.copy_to_folder'))
                        ->options(function(callable $get) {
                            return Arr::where($this->translationFolders, function ($value, $key) use ($get) {
                                return $value !== $get('copy_from_folder');
                            });
                        })
                        ->required()
                        ->searchable(),
                ]),

            Action::make('Merge Files')
                ->label(trans('dashboard.merge_files'))
                ->action(function (array $data): void {
                    TranslationService::mergeTranslationFile($data);
                    Notification::make()->title('Saved successfully')->success()->send();
                })
                ->form([
                    Select::make('merge_from_folder')
                        ->label(trans('dashboard.merge_from_folder'))
                        ->options($this->translationFolders)
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn (callable $set) => $set('merge_from_file', null))
                        ->searchable(),

                    Select::make('merge_from_file')
                        ->label(trans('dashboard.merge_from_file'))
                        ->options(function(callable $get) {
                            return TranslationService::getTranslationFilesFromFolder($get('merge_from_folder'));
                        })
                        ->required()
                        ->searchable(),

                    Select::make('merge_to_folder')
                        ->label(trans('dashboard.merge_to_folder'))
                        ->options(function(callable $get) {
                            return Arr::where($this->translationFolders, function ($value, $key) use ($get) {
                                return $value !== $get('merge_from_folder');
                            });
                        })
                        ->required()
                        ->searchable(),

                    Select::make('merge_to_file')
                        ->label(trans('dashboard.merge_to_file'))
                        ->options(function(callable $get) {
                            return TranslationService::getTranslationFilesFromFolder($get('merge_to_folder'));
                        })
                        ->required()
                        ->searchable(),
                ]),
        ];
    }


}
