<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'model_type',
        'model_id',
        'locale',
        'hash',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
