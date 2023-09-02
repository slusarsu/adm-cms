<?php

namespace App\Filament\Resources\AdmFormResource\RelationManagers;

use App\Adm\Enums\AdmMailStatusEnum;
use App\Adm\Services\AdmFormService;
use Filament\Forms\Components\KeyValue;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Novadaemon\FilamentPrettyJson\PrettyJson;

class AdmFormItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'admFormItems';

    protected static ?string $recordTitleAttribute = 'adm_form_id';

    public static function getTitle(): string
    {
        return trans('dashboard.adm_form_items');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                KeyValue::make('payload')
//                    ->disableLabel()
//                    ->columnSpanFull(),
                PrettyJson::make('payload')
                    ->label(trans('dashboard.payload'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),

                BadgeColumn::make('status')
                    ->label(trans('dashboard.status'))
                    ->colors([
                        'primary',
                        'danger' => AdmMailStatusEnum::ERROR_SENT->value,
                        'warning' => AdmMailStatusEnum::NOT_SENT->value,
                        'success' => AdmMailStatusEnum::SENT->value,
                    ]),

                TextColumn::make('payload')
                    ->label(trans('dashboard.payload'))
                    ->limit(150, '...')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label(trans('dashboard.created'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Action::make('Send')
                    ->action(function ($record) {
                        AdmFormService::sendEmailForItem($record);
                        Notification::make()->title('Sent')
                            ->success()
                            ->icon('heroicon-o-bell')
                            ->send();
                    } )
                    ->icon('heroicon-s-paper-airplane')
                    ->requiresConfirmation(),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
