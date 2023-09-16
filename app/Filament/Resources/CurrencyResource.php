<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurrencyResource\Pages;
use App\Filament\Resources\CurrencyResource\RelationManagers;
use App\Models\Currency;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?int $navigationSort = 7;

    protected static function getNavigationLabel(): string
    {
        return trans('shop.currencies');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('shop.currencies');
    }

    public static function getModelLabel(): string
    {
        return trans('shop.currency');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return siteSetting()->get('shopEnabled');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('code')
                        ->label(trans('shop.currency_code'))
                        ->required(),

                    TextInput::make('name')
                        ->label(trans('shop.name'))
                        ->required(),

                    TextInput::make('symbol')
                        ->label(trans('shop.symbol'))
                        ->required(),

                    Toggle::make('is_enabled')
                        ->label(trans('dashboard.enabled'))
                        ->default(true),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('code')
                    ->label(trans('shop.currency_code'))
                    ->sortable(),

                TextColumn::make('symbol')
                    ->label(trans('shop.symbol'))
                    ->sortable(),

                TextColumn::make('name')
                    ->label(trans('shop.name'))
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
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCurrencies::route('/'),
            'create' => Pages\CreateCurrency::route('/create'),
            'edit' => Pages\EditCurrency::route('/{record}/edit'),
        ];
    }
}
