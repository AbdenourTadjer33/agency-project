<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'country',
        'city',
        'address',
        'coordinates',
        'classification',
        'number_rooms',
        'services',
        'assets',
    ];

    protected $casts = [
        'coordinates' => 'array',
        'services' => 'array',
        'assets' => 'array',
    ];

    public function booking(): MorphOne
    {
        return $this->morphOne(Booking::class, 'bookingable');
    }

    public function pricing(): MorphOne
    {
        return $this->morphOne(Pricing::class, 'pricingable');
    }

    public function calculatePrice($counts, $formule)
    {
        $pricings = $this->pricing;
        $formulePrice = floatval($this->getAppropriateFormulePrice($formule));

        $nbAdult = intval($counts['adult']);
        $nbChild = intval($counts['child']);
        $nbBaby = intval($counts['baby']);

        $client = $nbAdult + $nbChild;

        return ($nbAdult * $pricings->price_adult) + ($nbChild * $pricings->price_child) + ($nbBaby * $pricings->price_baby) + ($client * $formulePrice);
    }

    protected function getAppropriateFormulePrice($formuleBase)
    {
        if ($formuleBase == 'LPD') {
            return $this->pricing->price_lpd;
        } else if ($formuleBase == 'LPC') {
            return $this->pricing->price_lpc;
        } else if ($formuleBase == 'LDP') {
            return $this->pricing->price_ldp;
        }
    }
}
