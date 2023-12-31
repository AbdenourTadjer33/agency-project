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

    public function delete(Request $request, $ref)
    {
        $booking = Booking::where('ref', $ref)->firstOrFail();
        if (!$booking->delete()) {
            return redirect()->back()->with('error', 'Réservation n° ' . $booking->ref  . ' n\' pas pu étre suprimmer');
        }
        return redirect()->back()->with('status', 'Réservation suprimmer avec ' . $booking->ref . ' succés');
    }
}
