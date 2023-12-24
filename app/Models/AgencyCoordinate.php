<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgencyCoordinate extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'name',
        'coordinates',
        'address',
        'city',
        'zip'
    ]; 

    public function agency () : BelongsTo {
        return $this->belongsTo(Agency::class);
    }
    
    protected $casts = [
        'coordinates' => 'array',
    ];


}
