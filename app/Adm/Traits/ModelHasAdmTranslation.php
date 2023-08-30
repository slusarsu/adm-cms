<?php

namespace App\Adm\Traits;

use App\Models\AdmTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait ModelHasAdmTranslation
{
    public function scopeLang(Builder $query): void
    {
        $query->where('locale', app()->getLocale());
    }
    public function translation(): HasOne
    {
        return $this->hasOne(AdmTranslation::class, 'model_id', 'id')->where('model_type', get_called_class());
    }

    public function translations(): \Illuminate\Database\Eloquent\Collection|array
    {
        $translation = $this->translation()->first();

        if(!$translation) {
            return [];
        }

        return AdmTranslation::query()->where('hash', $translation->hash)->get();
    }
    public function getTranslationLocales(): string
    {
        $translations = $this->translations();

        if(!$translations) {
            return '';
        }

        $languages = $translations->where('locale', '!=', $this->locale)->pluck('locale')->all() ?? [];

        return implode(' ', $languages);
    }
}
