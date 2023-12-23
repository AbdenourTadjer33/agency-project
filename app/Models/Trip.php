<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'destination',
        'city',
        'formule_base',
        'assets',
        'trip_category_id',
        'hotel_id',
    ];

    public $cast = [
        'assets' => 'array',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function tripCategory(): BelongsTo
    {
        return $this->belongsTo(TripCategorie::class,);
    }

    public function tripDates(): HasMany
    {
        return $this->hasMany(TripDate::class);
    }

    public function booking(): MorphOne
    {
        return $this->morphOne(Booking::class, 'bookingable');
    }

    public function pricing(): MorphOne
    {
        return $this->morphOne(Pricing::class, 'pricingable');
    }

    public function calculatePrice($counts)
    {
        $pricings = $this->pricing;

        $nbAdult = intval($counts['adult']);
        $nbChild = intval($counts['child']);
        $nbBaby = intval($counts['baby']);

        return ($nbAdult * $pricings->price_adult) + ($nbChild * $pricings->price_child) + ($nbBaby * $pricings->price_baby);

    }

    protected function getAppropriatePriceFormule($formuleBase)
    {
        $tab = [
            'LPD' => 'price_lpd',
            'LDP' => 'price_ldp',
            'LPC' => 'price_lpc',
        ];
        return $tab[$formuleBase];
    }
}
