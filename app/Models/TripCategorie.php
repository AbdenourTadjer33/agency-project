<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TripCategorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function trip(): HasOne {
        return $this->hasOne(Trip::class);
    }
}
