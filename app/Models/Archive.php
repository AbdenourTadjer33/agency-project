<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_uuid',
        'data',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    protected $casts = [
        'data' => 'object',
    ];
}
