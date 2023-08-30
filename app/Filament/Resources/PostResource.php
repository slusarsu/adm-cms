<?php

namespace App\Filament\Resources;

use App\Adm\Actions\ActionAdmTranslationMapper;
use App\Adm\Services\CustomFieldService;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\Widgets\PostStatsOverview;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use function Filament\Support\get_model_label;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 0;

    protected static ?string $contentType = 'post';

    protected static function getNavigationLabel(): string
    {
        return trans('dashboard.posts');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('dashboard.posts');
    }

    public static function getModelLabel(): string
    {
        return trans('dashboard.post');
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
                        ])->collapsible(),

                    Tabs::make('Heading')
                        ->tabs([
                            Tab::make(trans('dashboard.images'))
                                ->icon('heroicon-o-film')
                                ->schema([
                                    FileUpload::make('images')
                                        ->label(trans('dashboard.images'))
                                        ->directory('images')->multiple()->image()
                                ])  ,
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

                            Tab::make('custom_fields')
                                ->label(trans('dashboard.custom_fields'))
                                ->icon('heroicon-o-document-text')
                                ->schema(function($record) {

                                    if(empty($record)) {
                                        return [];
                                    }

                                    return CustomFieldService::customFieldsByPostType($record->type);
                                }),
                        ]),

                ])->columnSpan(3),

                Group::make()->schema([

                    Section::make(trans('dashboard.taxonomy'))
                        ->schema([

                            Select::make('categories')
                                ->label(trans('dashboard.categories'))
                                ->multiple()
                                ->preload()
                                ->relationship('categories', 'title')
                                ->createOptionForm([
                                    TextInput::make('title')
                                        ->label(trans('dashboard.title'))
                                        ->required()
                                        ->lazy()
                                        ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'createOption' ? $set('slug', Str::slug($state)) : null),

                                    TextInput::make('slug')
                                        ->label(trans('dashboard.slug'))
                                        ->required()
                                        ->unique(Category::class, 'slug', ignoreRecord: true)
                                        ->reactive(),

                                    Select::make('post_type')
                                        ->label(trans('dashboard.type'))
                                        ->options(function() {
                                            return config('adm.post_types');
                                        })
                                        ->default('text')
                                        ->reactive()
                                        ->searchable(),

                                    Select::make('parent_id')
                                        ->label(trans('dashboard.parent'))
                                        ->options(function(callable $get) {
                                            if($get('post_type')) {
                                                return Category::query()
                                                    ->where('content_type', static::$contentType)
                                                    ->where('post_type', $get('post_type'))
                                                    ->pluck('title', 'id');
                                            }
                                            return Category::query()
                                                ->where('content_type', static::$contentType)
                                                ->pluck('title', 'id');
                                        })
                                        ->searchable(),

                                    Select::make('locale')
                                        ->label(trans('dashboard.locale'))
                                        ->options(admLanguages())
                                        ->default(admDefaultLanguage()),

                                    TextInput::make('content_type')
                                        ->required()
                                        ->default('post')
                                        ->hidden(),
                                ]),

                            Select::make('tags')
                                ->label(trans('dashboard.tags'))
                                ->multiple()
                                ->preload()
                                ->relationship('tags', 'title')
                                ->createOptionForm([
                                    TextInput::make('title')
                                        ->label(trans('dashboard.title'))
                                        ->required()
                                        ->lazy()
                                        ->unique(Tag::class, 'title', ignoreRecord: true)
                                        ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'createOption' ? $set('slug', Str::slug($state)) : null),

                                    TextInput::make('slug')
                                        ->label(trans('dashboard.slug'))
                                        ->required()
                                        ->unique(Tag::class, 'slug', ignoreRecord: true),

                                ]),

                            Select::make('type')
                                ->label(trans('dashboard.type'))
                                ->reactive()
                                ->afterStateUpdated(fn (callable $set) => $set('Heading.custom_fields', null))
                                ->options(
                                    config('adm.post_types')
                                )->default('text'),

                        ])
                        ->collapsible(),

                    Section::make(trans('dashboard.settings'))
                        ->schema([
                            FileUpload::make('thumb')
                                ->label(trans('dashboard.thumb'))
                                ->directory('images')->image(),

                            Select::make('locale')
                                ->label(trans('dashboard.locale'))
                                ->options(admLanguages())
                                ->default(admDefaultLanguage()),

                            DateTimePicker::make('created_at')
                                ->label(trans('dashboard.created'))
                                ->default(Carbon::now()),

                            Toggle::make('is_enabled')
                                ->label(trans('dashboard.enabled'))
                                ->default(true),

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
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->limit(50)
                    ->label(trans('dashboard.slug')),

                TextColumn::make('type')
                    ->label(trans('dashboard.type')),

                TextColumn::make('locale')
                    ->label(trans('dashboard.locale')),

                TextColumn::make('locales')
                    ->label(trans('dashboard.translations'))
                    ->description(fn ($record): string => $record->getTranslationLocales(), position: 'above'),

                TagsColumn::make('categories.title')
                    ->label(trans('dashboard.categories'))
                    ->separator(','),

                TagsColumn::make('tags.title')
                    ->label(trans('dashboard.tags'))
                    ->separator(','),

                IconColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled'))
                    ->boolean(),

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
                ActionAdmTranslationMapper::make(),
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
            PostResource\RelationManagers\CommentsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PostStatsOverview::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
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
