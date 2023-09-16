<?php

namespace App\Filament\Resources;

use App\Adm\Services\CustomFieldService;
use App\Filament\Resources\ShopDiscountResource\Pages;
use App\Filament\Resources\ShopDiscountResource\RelationManagers;
use App\Models\ShopCategory;
use App\Models\ShopDiscount;
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
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ShopDiscountResource extends Resource
{
    protected static ?string $model = ShopDiscount::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-emoji-happy';

    protected static ?int $navigationSort = 4;

    protected static function getNavigationLabel(): string
    {
        return trans('shop.discounts');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('shop.discounts');
    }

    public static function getModelLabel(): string
    {
        return trans('shop.discount');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return siteSetting()->get('shopEnabled');
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

                            TextInput::make('amount')
                                ->label(trans('shop.amount'))
                                ->mask(
                                    fn (Mask $mask, callable $get) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 2)
                                ),

                            TinyEditor::make('content')
                                ->label(trans('dashboard.content'))
                                ->fileAttachmentsDisk('local')
                                ->fileAttachmentsVisibility('storage')
                                ->fileAttachmentsDirectory('public/images')
                                ->setConvertUrls(false),
                        ]),
                ])->columnSpan(3),

                Group::make()->schema([


                    Section::make(trans('dashboard.settings'))
                        ->schema([
                            DateTimePicker::make('created_at')
                                ->label(trans('dashboard.created'))
                                ->default(Carbon::now()),

                            Toggle::make('is_percent')
                                ->label(trans('shop.percent'))
                                ->default(false),


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

                TextColumn::make('slug')
                    ->limit(50)
                    ->label(trans('dashboard.slug')),

                TextColumn::make('amount')
                    ->label(trans('shop.amount')),

                TextColumn::make('percent')
                    ->label(trans('shop.percent')),

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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListShopDiscounts::route('/'),
            'create' => Pages\CreateShopDiscount::route('/create'),
            'edit' => Pages\EditShopDiscount::route('/{record}/edit'),
        ];
    }
}
