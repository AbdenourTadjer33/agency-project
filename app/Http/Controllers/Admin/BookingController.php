<?php

namespace App\Http\Controllers\Admin;

use App\Models\Like;
use App\Models\Trip;
use App\Models\User;
use App\Models\Archive;
use App\Models\Booking;
use App\Models\BookingTrip;
use App\Models\BookingHotel;
use Illuminate\Http\Request;
use App\Models\BookingTicketing;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

    public function postOffer(Request $request, $ref)
    {
        /**
         * @var Booking
         */
        $booking = Booking::where('ref', $ref)->first();
        if (!$booking && $booking->type == 'ticketing') return abort(404);

        $request->validate([
            'offer' => ['required'],
        ]);

        $booking->ticketingOffer()->create([
            'offer' => json_encode($request->offer),
        ]);

        $booking->status = Booking::OFFER;
        $booking->save();

        return redirect()->with('status', [
            'status' => 'succes',
            'message' => 'Votre offre  à été soumis avec succés',
        ]);
    }

    public function archive(Request $request, $ref)
    {
        /**
         * @var Booking
         */
        $booking = Booking::where('ref', $ref)->firstOrFail();

        if (!$booking->status && !$booking->date_departure->isPast()) {
            return redirect()->back()->with('status', ['status' => 'error', 'message' => 'Vous ne pouvez pas archiver cette résevation']);
        }

        switch ($booking->type) {
            case 'ticketing':
                $request->user()->archives()->create([
                    'type' => 'ticketing',
                    'archive_type' => Booking::class,
                    'archive_types' => json_encode([Booking::class, BookingTicketing::class]),
                    'data' => json_encode([
                        Booking::class => $booking,
                        BookingTicketing::class => $booking->ticketing,
                    ]),
                ]);
                break;
            case 'trip':
                $request->user()->archives()->create([
                    'type' => 'trip',
                    'archive_type' => Booking::class,
                    'archive_types' => json_encode([Booking::class, BookingTrip::class]),
                    'data' => json_encode([
                        Booking::class => $booking,
                        BookingTrip::class => $booking->bookingTrip,
                    ]),
                ]);
                break;
            case 'hotel':
                $request->user()->archives()->create([
                    'type' => 'hotel',
                    'archive_type' => Booking::class,
                    'archive_types' => json_encode([Booking::class, BookingHotel::class]),
                    'data' => json_encode([
                        Booking::class => $booking,
                        BookingHOtel::class => $booking->bookingHotel,
                    ]),
                ]);
                break;
        }

        $booking->delete();

        return redirect()->back()->with('status', [
            'status' => 'success',
            'message' => 'Réservation archiver avec ' . $booking->ref . ' succés',
        ]);
    }

    public function archiveBookings(Request $request)
    {
        $bookings = Booking::where('date_departure', '<', now())->with(['ticketing', 'bookingTrip', 'bookingHotel'])->get();

        /**
         * @var User
         */
        $user = $request->user();

        $allBookings = [];
        foreach ($bookings as $booking) {
            $allBookings[] = [
                'user_uuid' => $user->uuid,
                'archive_types' => json_encode([
                    Booking::class,
                    ($booking->type == 'trip' ? BookingTrip::class : $booking->type == 'ticketing') ? BookingTicketing::class : BookingHotel::class
                ]),
                'data' => json_encode([
                    Booking::class => $booking,
                    $booking->type == 'trip' ? BookingTrip::class : null => $booking->type == 'trip' ? $booking->bookingTrip : null,
                    $booking->type == 'ticketing' ? BookingTicketing::class : null => $booking->type == 'ticketing' ? $booking->ticketing : null,
                    $booking->type == 'hotel' ? BookingHotel::class : null => $booking->type == 'trip' ? $booking->bookingHotel : null,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        dd($allBookings[0]['data']);
        // Archive::insert($allBookings);
        
        // return $bookings->delete(); 

        // foreach ($bookings as $booking) {
        // $bookingDetails = false;
        // if ($booking->type == 'ticketing') {
        // $bookingDetails = $booking->ticketing;
        // } else if ($booking->type == 'hotel') {
        // $bookingDetails = $booking->bookingHotel;
        // } else if ($booking->type == 'trip') {
        // $bookingDetails = $booking->bookingTrip;
        // }
        // $request->user()->archives()->create([
        // 'data' => json_encode([
        // 'booking' => $booking,
        // 'bookingDetails' => $bookingDetails,
        // ]),
        // ]);
        // $booking->delete();
        // }

        // return redirect()->back()->with('status', count($bookings) . ' réservation' . (count($bookings) > 1 ? 's' : '') . ' sont archivé');
    }
}
