<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopOrderResource\Pages;
use App\Filament\Resources\ShopOrderResource\RelationManagers;
use App\Models\ShopOrder;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShopOrderResource extends Resource
{
    protected static ?string $model = ShopOrder::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    protected static ?int $navigationSort = 3;

    protected static function getNavigationLabel(): string
    {
        return trans('shop.orders');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('shop.orders');
    }

    public static function getModelLabel(): string
    {
        return trans('shop.order');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return siteSetting()->get('shopEnabled');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListShopOrders::route('/'),
            'create' => Pages\CreateShopOrder::route('/create'),
            'edit' => Pages\EditShopOrder::route('/{record}/edit'),
        ];
    }
}
