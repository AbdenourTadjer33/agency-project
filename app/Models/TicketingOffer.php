<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketingOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'offer',
    ];

    protected $casts = [
        'offer' => 'array',
    ];

    public function booking(): HasOne {
        return $this->hasOne(Booking::class);
    }
}
