<?php

namespace App\Adm\Actions;

use Filament\Tables\Actions\Action;

class ActionAdmTranslationMapper
{
    public static function make()
    {
        return Action::make(trans('dashboard.translate'))
            ->action(fn () => '')
            ->icon('heroicon-o-translate')
            ->url(function ($record){
                return route('filament.pages.adm-translation-selectors', [
                    'record' => $record->id,
                    'model_type' => class_basename($record),
                ]);
            });
    }
}
