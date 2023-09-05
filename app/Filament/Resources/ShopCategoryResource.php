<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopCategoryResource\Pages;
use App\Filament\Resources\ShopCategoryResource\RelationManagers;
use App\Models\Category;
use App\Models\ShopCategory;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ShopCategoryResource extends Resource
{
    protected static ?string $model = ShopCategory::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-view-list';

    protected static ?int $navigationSort = 1;

    protected static function getNavigationLabel(): string
    {
        return trans('shop.categories');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('shop.categories');
    }

    public static function getModelLabel(): string
    {
        return trans('shop.category');
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
                                ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                            TextInput::make('slug')
                                ->label(trans('dashboard.slug'))
                                ->required()
                                ->unique(self::getModel(), 'slug', ignoreRecord: true),

                            TextInput::make('order')
                                ->label(trans('dashboard.order'))
                                ->integer(true)
                                ->default(0),

                            Select::make('parent_id')
                                ->label(trans('dashboard.parent'))
                                ->options(function($record) {
                                    if($record) {
                                        return ShopCategory::query()
                                            ->whereNot('id', $record->id)
                                            ->pluck('title', 'id');
                                    }
                                    return ShopCategory::query()
                                        ->pluck('title', 'id');
                                })
                                ->searchable(),

                            TinyEditor::make('content')
                                ->label(trans('dashboard.content'))
                                ->fileAttachmentsDisk('local')
                                ->fileAttachmentsVisibility('storage')
                                ->fileAttachmentsDirectory('public/images')
                                ->setConvertUrls(false)
                        ]),

                    Section::make('SEO')
                        ->schema([
                            TextInput::make('seo_title')
                                ->label(trans('dashboard.seo_title'))
                                ->columnSpan('full'),
                            Textarea::make('seo_text_keys')
                                ->label(trans('dashboard.seo_key_words'))
                                ->columnSpan('full'),
                            Textarea::make('seo_description')
                                ->label(trans('dashboard.seo_description'))
                                ->columnSpan('full'),
                        ])->collapsible()->collapsed(),


                ])->columnSpan(3),

                Group::make()->schema([

                    Section::make(trans('dashboard.settings'))
                        ->schema([

                            FileUpload::make('thumb')
                                ->label(trans('dashboard.thumb'))
                                ->directory('images')
                                ->image(),

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
                        ]),

                ])
                    ->columnSpan(1),

            ])
            ->columns(4);
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

                TextColumn::make('order')
                    ->label(trans('dashboard.order'))
                    ->sortable(),

                TextColumn::make('parent.title')
                    ->label(trans('dashboard.parent'))
                    ->sortable(),

                IconColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled'))
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('only_enabled')
                    ->label(trans('dashboard.only_enabled'))
                    ->query(fn (Builder $query): Builder => $query->where('is_enabled', true))
                    ->toggle()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShopCategories::route('/'),
            'create' => Pages\CreateShopCategory::route('/create'),
            'edit' => Pages\EditShopCategory::route('/{record}/edit'),
        ];
    }
}
