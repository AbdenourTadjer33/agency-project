<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'faq_id',
        'message',
    ];

    public function faq(): BelongsTo {
        return $this->belongsTo(Faq::class, 'faq_id', 'id');
    }
}
