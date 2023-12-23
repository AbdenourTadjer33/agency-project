<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'formule'
    ];


    public function booking() : BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public $timestamps = false;
}
