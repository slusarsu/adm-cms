<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms;
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

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-globe';

    protected static ?int $navigationSort = 7;

    protected static function getNavigationLabel(): string
    {
        return trans('shop.countries');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('shop.countries');
    }

    public static function getModelLabel(): string
    {
        return trans('shop.country');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return siteSetting()->get('shopEnabled');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    TextInput::make('name')
                        ->label(trans('shop.country_name'))
                        ->required(),

                    TextInput::make('code')
                        ->label(trans('shop.country_code'))
                        ->required(),

                    Toggle::make('is_enabled')
                        ->label(trans('dashboard.enabled'))
                        ->default(true),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('name')
                    ->label(trans('shop.country_name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('code')
                    ->label(trans('shop.country_code'))
                    ->sortable(),

                IconColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled'))
                    ->boolean()
                    ->sortable(),

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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
