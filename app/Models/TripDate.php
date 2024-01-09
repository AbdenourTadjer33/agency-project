<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'date_departure',
        'date_return'
    ];

    public $timestamps = false;

    protected $casts = [
        'date_departure' => 'datetime:Y-m-d',
        'date_return' => 'datetime:Y-m-d'
    ];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }


    public function getDuration()
    {
        $begin = Carbon::createMidnightDate($this->date_departure);
        $end = Carbon::createMidnightDate($this->date_return);
        return $begin->diffInDays($end, true);
    }
}
