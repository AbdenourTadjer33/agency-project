<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_uuid',
        'name',
        'message',
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function faqReponse(): HasOne {
        return $this->hasOne(FaqResponse::class, 'faq_id', 'id');
    }
}
