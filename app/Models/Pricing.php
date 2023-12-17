<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_adult',
        'price_child',
        'price_baby',
        'price_f1',
        'price_f2',
        'price_f3',
    ];

    public $timestamps = false;


    public function pricingable(): MorphTo
    {
        return $this->morphTo();
    }
}
