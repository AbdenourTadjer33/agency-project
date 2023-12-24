<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::with('user')->get();
        return view('admin.booking.index', [
            'bookings' => $bookings,
        ]);
    }

    public function show(Request $request, $ref) {
        $booking = Booking::where('ref', $ref)->firstOrFail();
        return view('admin.booking.show', [
            'booking' => $booking,
        ]);
    }

    public function acceptBooking(Request $request, $ref) {
        $booking = Booking::where('ref', $ref)->firstOrFail();
        $booking->status = 'validé';
        $booking->save();
        return redirect(route('admin.bookings'))->with('status', 'Réservation ' . $booking->ref . ' confirmé avec succés!');
    }

    public function refuseBooking(Request $request, $ref) {
        $booking = Booking::where('ref', $ref)->firstOrFail();
        $booking->status = 'non-validé';
        $booking->save();
        return redirect(route('admin.bookings'))->with('status', 'Réservation ' . $booking->ref . ' est non confirmé avec succés!');
    }
}
