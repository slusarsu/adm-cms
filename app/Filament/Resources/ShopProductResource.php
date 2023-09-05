<?php

namespace App\Filament\Resources;

use App\Adm\Actions\ActionAdmTranslationMapper;
use App\Adm\Services\CurrencyService;
use App\Adm\Services\CustomFieldService;
use App\Filament\Resources\ShopProductResource\Pages;
use App\Filament\Resources\ShopProductResource\RelationManagers;
use App\Models\Category;
use App\Models\ShopCategory;
use App\Models\ShopProduct;
use App\Models\Tag;
use Filament\Forms;
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
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ShopProductResource extends Resource
{
    protected static ?string $model = ShopProduct::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';

    protected static ?int $navigationSort = 2;

    protected static function getNavigationLabel(): string
    {
        return trans('shop.products');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('shop.products');
    }

    public static function getModelLabel(): string
    {
        return trans('shop.product');
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
                                ->schema(CustomFieldService::customFieldsByPostType('shop_product_fields')),
                        ]),

                ])->columnSpan(3),

                Group::make()->schema([

                    Section::make(trans('shop.product_price'))
                        ->schema([

                            Select::make('currency_id')
                                ->label(trans('dashboard.locale'))
                                ->options(CurrencyService::getList()),

                            TextInput::make('price')
                                ->label(trans('shop.price'))
                                ->mask(
                                    fn (Mask $mask, callable $get) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 2)
                                ),


                            TextInput::make('sku')
                                ->label(trans('shop.sku')),


                            TextInput::make('quantity')
                                ->label(trans('shop.quantity'))
                                ->integer()
                                ->default(0),

                            Select::make('shop_discount_id')
                                ->label(trans('shop.discount'))
                                ->preload()
                                ->searchable()
                                ->relationship('shopDiscount', 'title'),
                        ]),

                    Section::make(trans('dashboard.settings'))
                        ->schema([

                            Select::make('shop_category_id')
                                ->label(trans('dashboard.category'))
                                ->preload()
                                ->searchable()
                                ->relationship('shopCategory', 'title')
                                ->createOptionForm([
                                    TextInput::make('title')
                                        ->label(trans('dashboard.title'))
                                        ->required()
                                        ->lazy()
                                        ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'createOption' ? $set('slug', Str::slug($state)) : null),

                                    TextInput::make('slug')
                                        ->label(trans('dashboard.slug'))
                                        ->required()
                                        ->unique(ShopCategory::class, 'slug', ignoreRecord: true)
                                        ->reactive(),

                                    Select::make('parent_id')
                                        ->label(trans('dashboard.parent'))
                                        ->options(ShopCategory::query()->pluck('title', 'id'))
                                        ->searchable(),

                                    Select::make('locale')
                                        ->label(trans('dashboard.locale'))
                                        ->options(admLanguages())
                                        ->default(admDefaultLanguage()),
                                ]),

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

                TextColumn::make('price')
                    ->label(trans('shop.price')),

                TextColumn::make('quantity')
                    ->label(trans('shop.quantity')),

                TextColumn::make('locale')
                    ->label(trans('dashboard.locale')),

                TextColumn::make('locales')
                    ->label(trans('dashboard.translations'))
                    ->description(fn ($record): string => $record->getTranslationLocales(), position: 'above'),

                TextColumn::make('shopCategory.title')
                    ->label(trans('dashboard.category')),

                TextColumn::make('shopDiscount.title')
                    ->label(trans('shop.discount')),

                TextColumn::make('currency.code')
                    ->label(trans('shop.currency')),

                IconColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled'))
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionAdmTranslationMapper::make(),
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
            'index' => Pages\ListShopProducts::route('/'),
            'create' => Pages\CreateShopProduct::route('/create'),
            'edit' => Pages\EditShopProduct::route('/{record}/edit'),
        ];
    }
}
