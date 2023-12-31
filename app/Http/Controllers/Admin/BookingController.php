<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Archive;

class BookingController extends Controller
{

    public function trips(Request $request)
    {
        $bookings = Booking::where('type', 'trip');

        if ($request->status && $request->status != 'all' && in_array($request->status, Booking::ALLSTATUS)) {
            $bookings->where('status', $request->status);
        }

        if (!$request->order_by) {
            $bookings->latest();
        } else {
            $bookings->oldest();
        }

        return view('admin.booking.trips', [
            'bookings' => $bookings->with([
                'user:uuid,first_name,last_name',
                'bookingable',
                'bookingTrip'
            ])->paginate($request->pagination > 15 || $request->pagination == null ? 6 : $request->pagination),
        ]);
    }

    public function hotels(Request $request)
    {
        $bookings = Booking::where('type', 'hotel');

        if ($request->status && $request->status != 'all' && in_array($request->status, Booking::ALLSTATUS)) {
            $bookings->where('status', $request->status);
        }

        if (!$request->order_by) {
            $bookings->latest();
        } else {
            $bookings->oldest();
        }

        return view('admin.booking.hotels', [
            'bookings' => $bookings->with([
                'user:uuid,first_name,last_name',
                'bookingable',
                'bookingHotel'
            ])->paginate($request->pagination > 15 || $request->pagination == null ? 6 : $request->pagination),
        ]);
    }

    public function ticketings(Request $request)
    {
        $bookings = Booking::where('type', 'ticketing');
        // dd($bookings);
        if ($request->status && $request->status != 'all' && in_array($request->status, Booking::ALLSTATUS)) {
            $bookings->where('status', $request->status);
        }

        if (!$request->order_by) {
            $bookings->latest();
        } else {
            $bookings->oldest();
        }

        return view('admin.booking.ticketing', [
            'bookings' => $bookings->with([
                'user:uuid,first_name,last_name',
                'ticketing'
            ])->paginate($request->pagination > 15 || $request->pagination == null ? 6 : $request->pagination),
        ]);
    }

    public function show(Request $request, $ref)
    {
        $booking = Booking::where('ref', $ref)->firstOrFail();
        return view('admin.booking.show', [
            'booking' => $booking,
        ]);
    }

    public function acceptBooking($ref)
    {
        $booking = Booking::where('ref', $ref)->firstOrFail();
        $booking->status = 'validé';
        $booking->save();

        switch ($booking->type) {
            case 'trip':
                return redirect(route('admin.bookings.trip'))->with('status', 'Réservation ' . $booking->ref . ' confirmé avec succés!');
                break;
            case 'hotel':
                return redirect(route('admin.bookings.hotel'))->with('status', 'Réservation ' . $booking->ref . ' confirmé avec succés!');
                break;
            case 'ticketing':
                return redirect(route('admin.bookings.ticketing'))->with('status', 'Réservation ' . $booking->ref . ' confirmé avec succés!');
                break;
            default:
                abort(404);
        }
    }

    public function refuseBooking($ref)
    {
        $booking = Booking::where('ref', $ref)->firstOrFail();
        $booking->status = 'non-validé';
        $booking->save();

        switch ($booking->type) {
            case 'trip':
                return redirect(route('admin.bookings.trip'))->with('status', 'Réservation ' . $booking->ref . ' confirmé avec succés!');
                break;
            case 'hotel':
                return redirect(route('admin.bookings.hotel'))->with('status', 'Réservation ' . $booking->ref . ' confirmé avec succés!');
                break;
            case 'ticketing':
                return redirect(route('admin.bookings.ticketing'))->with('status', 'Réservation ' . $booking->ref . ' confirmé avec succés!');
                break;
            default:
                abort(404);
        }
    }

    public function archive(Request $request, $ref)
    {
        $booking = Booking::where('ref', $ref)->firstOrFail();

        if (!$booking->status && !$booking->date_departure->isPast()) {
            return redirect()->back()->with('error', 'Vous devez changer le status de la réservation, pour pouvoir la supprimer');
        }
        // // get booking details
        $bookingDetails = false;
        if ($booking->type == 'ticketing') {
            $bookingDetails = $booking->ticketing;
        } else if ($booking->type == 'hotel') {
            $bookingDetails = $booking->bookingHotel;
        } else if ($booking->type == 'trip') {
            $bookingDetails = $booking->bookingTrip;
        }
        // check if there is details
        if (!$bookingDetails) {
            return redirect()->back()->with('error', 'une erreur est survenu, pls report this bug');
        }

        $request->user()->archives()->create([
            'data' => json_encode([
                'booking' => $booking,
                'bookingDetails' => $bookingDetails,
            ]),
        ]);

        if (!$booking->delete()) {
            return redirect()->back()->with('error', 'Réservation n° ' . $booking->ref  . ' n\' pas pu étre archiver');
        }
        return redirect()->back()->with('status', 'Réservation archiver avec ' . $booking->ref . ' succés');
    }

    public function archiveBookings(Request $request)
    {
        $bookings = Booking::where('date_departure', '<', now())->with(['ticketing', 'bookingTrip', 'bookingHotel'])->get();
        foreach ($bookings as $booking) {
            // load details
            $bookingDetails = false;
            if ($booking->type == 'ticketing') {
                $bookingDetails = $booking->ticketing;
            } else if ($booking->type == 'hotel') {
                $bookingDetails = $booking->bookingHotel;
            } else if ($booking->type == 'trip') {
                $bookingDetails = $booking->bookingTrip;
            }
            // archive the booking
            $request->user()->archives()->create([
                'data' => json_encode([
                    'booking' => $booking,
                    'bookingDetails' => $bookingDetails,
                ]),
            ]);
            $booking->delete();
        }

        return redirect()->back()->with('status', count($bookings) . ' réservation' . (count($bookings) > 1 ? 's' : '') . ' sont archivé');
    }
}
