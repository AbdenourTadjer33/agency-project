<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('booking.index', [
            'bookings' => $request->user()->bookings
        ]);
    }

    public function show(Request $request, $ref)
    {
        return view('booking.show', [
            'booking' => $request->user()->bookings()->where('ref', $ref)->firstOrFail(),
        ]);
    }

    public function update(Request $request, $ref)
    {
        /** 
         * @var Booking
         */
        $booking = Booking::where('ref', $ref)->first();

        switch ($booking->type) {
            case 'trip':
                $isBooking = $booking->updateTripBooking($request->user());
                break;
            case 'hotel':
                $isBooking = $booking->updateHotelBooking($request->user());
                break;
            case 'ticketing':
                $isBooking = $booking->updateticketingBooking($request->user());
                break;
        }

        if (!$isBooking) {
            return redirect()
                ->back()
                ->with('status', [
                    'status' => 'error',
                    'message' => 'Cette réservation ne peut pas étre modifié', 
                ]);
        }

        // Booking validation
        $request->validate([]);

        if ($booking->type == 'trip') {
            // validate DATA TripBooking
            // update DATA TripBooking
        } elseif ($booking->type == 'hotel') {
            // validate DATA HotelBooking
            // update DATA HotelBooking

        } elseif ($booking->type == 'ticketing') {
            // validate DATA TicketingBooking
            // validate DATA TicketingBooking
        }

        return redirect()
            ->back()
            ->with('status', ['status' => 'succes', 'message' => 'Votre réservation à été modifier avec succés']);
    }

    public function AcceptTicketing(Request $request)
    {
        $booking = Booking::where('ref', $request->ref)->first();
        if ($booking->type == 'ticketing') {
            $booking->status = Booking::ACCEPTED;
            $booking->save();
            // event accepted deal
            return redirect();
        }
    }

    public function RefuseTicketing(Request $request)
    {
        $booking = Booking::where('ref', $request->ref)->first();
        if ($booking->type == 'ticketing') {
            $booking->status = Booking::NOTACCEPTED;
            $booking->save();
            // event not accepted deal
            return redirect();
        }
    }

    public function cancel(Request $request, $ref)
    {
        /**
         * @var Booking
         */
        $booking = Booking::where('ref', $ref)->firstOrFail();
        switch ($booking->status) {
            case $booking->status == 'trip':
                $deleted = $booking->deleteTripBooking($request->user());
                break;
            case $booking->status == 'hotel':
                $deleted = $booking->deleteHotelBooking($request->user());
                break;
            case $booking->status == 'ticketing':
                $deleted = $booking->deleteTripBooking($request->user());
                break;
            default:
                break;
        }

        if (!$deleted) return abort(500);

        return redirect()
            ->back()
            ->with('status', [
                'status' => 'succes',
                'message' => 'Votre réservation à été annulé'
            ]);
    }

    public function archive() {
        // archive
        
    }
}

// modifiable
/**
 * Trip - hotel => *update* 48h avant check-in in case of valid or not valid.
 * ticketing => if deal accepted (no - update) || if no deal update §§
 */
// annulable
/**
 * Trip - hotel => "delete" 72h avant check-in in case of accpted or not accepted
 * ticketing => if deal accepted (no - delete) || if no deal delete §§
 */
