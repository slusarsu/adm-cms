<?php

namespace App\Filament\Resources;

use App\Adm\Services\PageService;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\Widgets\PageStatsOverview;
use App\Models\Page;
use Filament\Forms\Components\Builder as FromBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 1;

    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.pages');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.pages');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.page');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([

                    Card::make()
                        ->schema([
                            TextInput::make('title')
                                ->label(trans('dashboard.title'))
                                ->required()
                                ->lazy()
                                ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null)
                                ->columnSpanFull(),

                            TextInput::make('slug')
                                ->label(trans('dashboard.slug'))
                                ->required()
                                ->unique(self::getModel(), 'slug', ignoreRecord: true)
                                ->columnSpanFull(),

                            TinyEditor::make('short')
                                ->label(trans('dashboard.short'))
                                ->fileAttachmentsDisk('local')
                                ->fileAttachmentsVisibility('storage')
                                ->fileAttachmentsDirectory('public/images')
                                ->setConvertUrls(false)
                        ]),

                    Section::make(trans('dashboard.content'))
                        ->schema([
                            TinyEditor::make('content')
                                ->label(trans('dashboard.content'))
                                ->fileAttachmentsDisk('local')
                                ->fileAttachmentsVisibility('storage')
                                ->fileAttachmentsDirectory('public/images')
                                ->setConvertUrls(false)
                        ]),

                    Tabs::make('Heading')
                        ->tabs([
                            Tab::make(trans('dashboard.images'))
                                ->icon('heroicon-o-film')
                                ->schema([
                                    FileUpload::make('images')
                                        ->label(trans('dashboard.images'))
                                        ->directory('images')->multiple()->image()
                                ])  ,

                            Tab::make(trans('dashboard.custom_fields'))
                                ->icon('heroicon-o-document-text')
                                ->schema([
                                    FromBuilder::make('custom_fields')
                                        ->label(trans('dashboard.custom_fields'))
                                        ->blocks([
                                            Block::make('text_input')
                                                ->schema([

                                                    TextInput::make('field_name')
                                                        ->label(trans('dashboard.field_name')),

                                                    TextInput::make('text')
                                                        ->label(trans('dashboard.text'))

                                                ])
                                                ->label(fn (array $state): ?string => $state['field_name'] ?? null),
                                            Block::make('paragraph')
                                                ->schema([
                                                    TextInput::make('field_name')
                                                        ->label(trans('dashboard.field_name')),
                                                    Textarea::make('content')
                                                        ->label(trans('dashboard.paragraph'))
                                                        ->required(),
                                                ]),
                                            Block::make('content')
                                                ->schema([
                                                    TextInput::make('field_name')
                                                        ->label(trans('dashboard.field_name')),

                                                    TinyEditor::make('content')
                                                        ->label(trans('dashboard.content'))
                                                        ->fileAttachmentsDisk('local')
                                                        ->fileAttachmentsDirectory('public/images')
                                                        ->fileAttachmentsVisibility('storage')
                                                        ->setConvertUrls(false)
                                                ]),
                                            Block::make('image')
                                                ->schema([
                                                    TextInput::make('field_name')
                                                        ->label(trans('dashboard.field_name')),

                                                    FileUpload::make('url')
                                                        ->label(trans('dashboard.image'))
                                                        ->directory('images')
                                                        ->image()
                                                        ->required(),

                                                    TextInput::make('alt')
                                                        ->label(trans('dashboard.alt_text'))
                                                        ->required(),
                                                ]),
                                            Block::make('images')
                                                ->schema([
                                                    TextInput::make('field_name')
                                                        ->label(trans('dashboard.field_name')),

                                                    FileUpload::make('url')
                                                        ->label(trans('dashboard.images'))
                                                        ->directory('images')
                                                        ->multiple()
                                                        ->image()
                                                        ->required(),
                                                ]),
                                        ])
                                ]),

                            Tab::make('SEO')
                                ->icon('heroicon-o-folder')
                                ->schema([
                                    TextInput::make('seo_title')
                                        ->label(trans('dashboard.seo_title'))
                                        ->columnSpan('full'),

                                    TextInput::make('seo_text_keys')
                                        ->label(trans('dashboard.seo_key_words'))
                                        ->columnSpan('full'),

                                    Textarea::make('seo_description')
                                        ->label(trans('dashboard.seo_description'))
                                        ->columnSpan('full'),
                                ]),
                        ]),

                ])->columnSpan(3),

                Group::make()->schema([

                    Section::make(trans('dashboard.settings'))
                        ->schema([
                            FileUpload::make('thumb')
                                ->label(trans('dashboard.thumb'))
                                ->directory('images')
                                ->image(),

                            Select::make('template')
                                ->label(trans('dashboard.template'))
                                ->options(PageService::getListOfPageTemplates())
                                ->default('page')
                                ->required(),

                            DateTimePicker::make('created_at')
                                ->label(trans('dashboard.created'))
                                ->default(Carbon::now()),

                            Toggle::make('is_enabled')
                                ->label(trans('dashboard.enabled'))
                                ->default(true)
                        ])->collapsible(),

                ])->columnSpan(1),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                ImageColumn::make('thumb')
                    ->label(trans('dashboard.thumb')),

                TextColumn::make('title')
                    ->label(trans('dashboard.title'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label(trans('dashboard.slug')),

                TextColumn::make('locale')
                    ->label(trans('dashboard.locale')),

                IconColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled'))
                    ->boolean(),

                TextColumn::make('template')
                    ->label(trans('dashboard.template'))
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
                Filter::make('only_enabled')
                    ->label(trans('dashboard.only_enabled'))
                    ->query(fn (Builder $query): Builder => $query->where('is_enabled', true))
                    ->toggle()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PageStatsOverview::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
