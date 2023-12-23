<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingTicketing extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'flight_type',
        'airport_departure',
        'airport_arrived',
        'compagnie',
        'class'
    ];

    public function booking() : BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public $timestamps = false;
}
