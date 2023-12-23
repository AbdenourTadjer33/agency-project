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
        $delete = Booking::where('ref', $ref)->firstOrFail()->delete();
        return $delete;
    }
}
