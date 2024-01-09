<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'first_name',
        'last_name',
        'sex',
        'dob',
        'phone',
        'email',
        'password',
        'role',
        'passport_id'
    ];

    public $incrementing = false;
    protected $primaryKey = 'uuid';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function replyFaq(): HasMany
    {
        return $this->hasMany(FaqResponse::class, 'admin_id', 'uuid');
    }

    public function verificationCodes(): HasMany
    {
        return $this->hasMany(VerificationCode::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class, 'user_uuid', 'uuid');
    }


    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isClient()
    {
        return $this->role === 'client';
    }

    public function roleToAdmin()
    {
        $this->role = 'admin';
        $this->save();
    }
}
