<?php

namespace App\Filament\Resources\MenuResource\RelationManagers;

use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'menu_items';

    protected static ?string $recordTitleAttribute = 'title';

    public static function getTitle(): string
    {
        return trans('dashboard.menu_items');
    }

    protected static function getRecordLabel(): ?string
    {
        return trans('dashboard.menu_item');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('title')
                        ->label(trans('dashboard.title'))
                        ->required(),

                    TextInput::make('link')
                        ->label(trans('dashboard.link')),

                    Select::make('parent_id')
                        ->label(trans('dashboard.parent'))
                        ->options(MenuItem::all()->pluck('title', 'id'))
                        ->searchable(),

                    TextInput::make('order')
                        ->label(trans('dashboard.order'))
                        ->integer(true)
                        ->default(0),

                    Toggle::make('is_enabled')
                        ->label(trans('dashboard.enabled'))
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')
                    ->label(trans('dashboard.title'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('link')
                    ->label(trans('dashboard.link')),

                TextColumn::make('parent.title')
                    ->label(trans('dashboard.parent'))
                    ->sortable(),
                TextColumn::make('order')
                    ->label(trans('dashboard.order'))
                    ->sortable(),
                IconColumn::make('is_enabled')
                    ->label(trans('dashboard.enabled'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])->defaultSort('order', 'asc');
    }
}
