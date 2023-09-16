<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopCustomerResource\Pages;
use App\Filament\Resources\ShopCustomerResource\RelationManagers;
use App\Models\Country;
use App\Models\ShopCategory;
use App\Models\ShopCustomer;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ShopCustomerResource extends Resource
{
    protected static ?string $model = ShopCustomer::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?int $navigationSort = 5;

    protected static function getNavigationLabel(): string
    {
        return trans('shop.customers');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('shop.customers');
    }

    public static function getModelLabel(): string
    {
        return trans('shop.customer');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'country']);
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

                            Select::make('country_id')
                                ->label(trans('shop.country'))
                                ->options(
                                    Country::query()->pluck('name', 'id')
                                )
                                ->searchable(),

                            TextInput::make('city')
                                ->label(trans('shop.city')),

                            TextInput::make('address_line_1')
                                ->label(trans('shop.address_line_1')),

                            TextInput::make('address_line_1')
                                ->label(trans('shop.address_line_2')),

                            TextInput::make('postal_code')
                                ->label(trans('shop.postal_code')),

                            TextInput::make('phone')
                                ->label(trans('shop.phone')),

                            TextInput::make('mobile')
                                ->label(trans('shop.mobile')),
                        ]),


                ])->columnSpan(3),

                Group::make()->schema([

                    Card::make()->schema([
                        Placeholder::make('user.id')
                            ->content(fn ($record) => $record->user->id),

                        Placeholder::make('user.name')
                            ->content(fn ($record) => $record->user->name),

                        Placeholder::make('user.email')
                            ->content(fn ($record) => $record->user->email),

                        Placeholder::make('user.created_at')
                            ->content(fn ($record) => $record->user->created_at),

                    ])->columnSpan(1),

                ])
                    ->columnSpan(1),

            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('user.email')
                    ->label(trans('dashboard.email'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('country.name')
                    ->label(trans('shop.country'))
                    ->sortable()
                    ->searchable(),


                TextColumn::make('city')
                    ->label(trans('shop.city'))
                    ->sortable()
                    ->searchable(),


                TextColumn::make('postal_code')
                    ->label(trans('shop.postal_code'))
                    ->sortable()
                    ->searchable(),


                TextColumn::make('mobile')
                    ->label(trans('shop.mobile'))
                    ->sortable()
                    ->searchable(),

            ])
            ->filters([

                SelectFilter::make('postal_code')
                    ->label(trans('shop.postal_code'))
                    ->options(ShopCustomer::query()->pluck('postal_code', 'postal_code'))
                    ->searchable(),

                SelectFilter::make('city')
                    ->label(trans('shop.city'))
                    ->options(ShopCustomer::query()->pluck('city', 'city'))
                    ->searchable(),

                SelectFilter::make('country.id')
                    ->label(trans('shop.country'))
                    ->options(Country::query()->pluck('name', 'id'))
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListShopCustomers::route('/'),
            'create' => Pages\CreateShopCustomer::route('/create'),
            'edit' => Pages\EditShopCustomer::route('/{record}/edit'),
        ];
    }
}
