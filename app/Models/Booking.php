<?php

namespace App\Models;

use App\Traits\RandomId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'price',
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

    public function ticketingOffer(): BelongsTo
    {
        return $this->belongsTo(TicketingOffer::class, 'booking_id', 'id');
    }

    protected $casts = [
        'beneficiaries' => 'array',
        'date_departure' => 'datetime:Y-m-d',
        'date_return' => 'datetime:Y-m-d'
    ];

    const ALLSTATUS = ['non-accepté', 'accepté', 'annulé', 'non-validé', 'validé', 'offer'];

    const VALID = 'validé';
    const NOTVALID = 'non-validé';
    const CANCLED = 'annulé';
    const ACCEPTED = 'accepté';
    const NOTACCEPTED = 'non-accepté';
    const OFFER = 'offer';

    public function updateTripBooking($user)
    {
        if (!$user) return abort(500);

        if (now() < $this->date_departure->subDays(2)) {
            return $this; // model apte to update
        } 
            // return redirect()->back()->with('status', [
            //     'status' => 'error',
            //     'message' => 'Cette réservation ne peut pas étre modifié.',
            // ]);
        return false;
    }

    public function updateHotelBooking($user)
    {
        if (!$user) return abort(500);

        if (now() < $this->date_departure->subDays(2)) {
            return $this;
        } 
            // return redirect()->back()->with('status', [
                // 'status' => 'error',
                // 'message' => 'Cette réservation ne peut pas étre modifié',
            // ]);
            return false;
    }

    public function updateticketingBooking($user)
    {
        if (!$user) return abort(500);

        if (!in_array($this->status, [Booking::ACCEPTED, Booking::NOTACCEPTED])) {
            return $this;
        }
            // return redirect()
            //     ->back()
            //     ->with('status', ['status' => 'error', 'message' => 'Vous ne pouvez pas modifié cette réservation par ce que vous avéz accepté de prendre le billet.']);
        return false;
    }

    public function deleteTripBooking($user)
    {
        if (!$user) {
            return abort(500);
        }

        if (now() < $this->date_departure->subDays(3)) {
            $this->status = Booking::CANCLED;
            Archive::create([
                'user_uuid' => $user->uuid,
                'type' => 'trip',
                'archive_type' => Booking::class,
                'archive_types' => json_encode([Booking::class, BookingTrip::class]),
                'data' => json_encode([
                    Booking::class => $this,
                    BookingTrip::class => $this->bookingTrip,
                ]),
            ]);
            return $this->delete();
        } else {
            return redirect()
                ->back()
                ->with('status', ['status' => 'succes', 'message' => 'Vous pouvez pas annuler cette réservation car vous avez depassé kes delai d\'annulation']);
        }
    }

    public function deleteHotelBooking($user)
    {
        if (!$user) return abort(500);

        if (now() < $this->date_departure->subDays(3)) {
            $this->status = Booking::CANCLED;
            Archive::create([
                'user_uuid' => $user->uuid,
                'type' => 'hotel',
                'archive_type' => Booking::class,
                'archive_types' => json_encode([Booking::class, BookingHotel::class]),
                'data' => json_encode([
                    Booking::class => $this,
                    BookingHotel::class => $this->bookingHotel,
                ]),
            ]);
            return $this->delete();
        } else {
            return redirect()
                ->back()
                ->with('status', 'Vous pouvez pas annuler cette réservation car vous avez depassé kes delai d\'annulation');
        }
    }

    public function deleteTicketingBooking($user)
    {
        if (!$user) {
            return abort(500);
        }

        if ($this->status = Booking::ACCEPTED) {
            return redirect()
                ->back()
                ->with('status', ['status' => 'danger', 'message' => 'Vous ne pouvez pas annulé cette réservation parceque vous avéz accepté de prendre le billet.']);
        } else {
            $this->status = Booking::CANCLED;
            Archive::create([
                'user_uuid' => $user->uuid,
                'type' => 'ticketing',
                'archive_type' => Booking::class,
                'archive_types' => json_encode([Booking::class, BookingHotel::class]),
                'data' => json_encode([
                    Booking::class => $this,
                    BookingHotel::class => $this->bookingHotel,
                ]),
            ]);
            return $this->delete();
        }
    }
}
