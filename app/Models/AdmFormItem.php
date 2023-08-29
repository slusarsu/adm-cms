<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmFormItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'adm_form_id',
        'payload',
        'status',
    ];

    protected $casts = [
        'payload' => 'array'
    ];

    public function admForm(): BelongsTo
    {
        return $this->belongsTo(AdmForm::class);
    }
}
