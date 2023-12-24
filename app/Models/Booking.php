<?php

namespace App\Models;

use App\Traits\RandomId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Booking extends Model
{
    use HasFactory, RandomId;

    protected $fillable = [
        'user_uuid',
        'ref',
        'type',
        'date_departure',
        'date_return',
        'status',
        'number_adult',
        'number_child',
        'number_baby',
        'beneficiaries',
        'observation',
        'is_payed',
        'is_online',
        'price'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function ticketing(): HasOne
    {
        return $this->hasOne(BookingTicketing::class);
    }

    public function bookingTrip(): HasOne
    {
        return $this->hasOne(BookingTrip::class);
    }

    public function bookingHotel(): HasOne
    {
        return $this->hasOne(BookingHotel::class);
    }

    public function bookingable(): MorphTo
    {
        return $this->morphTo();
    }
    
    protected $casts = [
        'beneficiaries' => 'array',
    ];
}
