<?php

namespace App\Models;

use App\Traits\RandomId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromoCode extends Model
{
    use HasFactory, RandomId;
    protected $fillable = [
        'code',
        'trip_id',
        'reduction',
    ];

    public function trips(): BelongsTo
    {
        return $this->belongsTo(Trip::class, 'trip_id', 'id');
    }

    public $timestamps = false;

}
