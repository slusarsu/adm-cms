<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopSessionResource\Pages;
use App\Filament\Resources\ShopSessionResource\RelationManagers;
use App\Models\ShopSession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShopSessionResource extends Resource
{
    protected static ?string $model = ShopSession::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-database';

    protected static ?int $navigationSort = 6;

    protected static function getNavigationLabel(): string
    {
        return trans('shop.sessions');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('shop.sessions');
    }

    public static function getModelLabel(): string
    {
        return trans('shop.session');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return siteSetting()->get('shopEnabled');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
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
            'index' => Pages\ListShopSessions::route('/'),
            'create' => Pages\CreateShopSession::route('/create'),
            'edit' => Pages\EditShopSession::route('/{record}/edit'),
        ];
    }
}
