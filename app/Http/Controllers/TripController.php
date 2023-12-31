<?php

namespace App\Http\Controllers;

use App\Events\BookingTrip;
use App\Models\Trip;
use App\Models\Booking;
use App\Events\NewBooking;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Validation\Rule;

class TripController extends Controller
{
    use HttpResponses;
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    public function index()
    {
        return view('trip.trips', [
            'trips' => Trip::all()
        ]);
    }

    public function show($slug)
    {
        // dd(Trip::where('slug', $slug)->first());
        return view('trip.show', [
            'trip' => Trip::where('slug', $slug)->with(['tripDates', 'hotel', 'pricing'])->first(),
        ]);
    }

    public function store(Request $request, $slug)
    {
        $trip = Trip::where('slug', $slug)->firstOrFail();

        $request->validate([
            'date_id' => ['required'],
            'formule' => ['required', Rule::in(['LPD', 'LDP', 'LPC'])],
            'nb_adult' => ['required', 'integer'],
            'nb_child' => ['required', 'integer'],
            'nb_baby' => ['required', 'integer'],

            'adult' => ['required', 'array', 'max:' . $request->nb_adult],
            'adult.*.fname' => ['required', 'string'],
            'adult.*.lname' => ['required', 'string'],
            'adult.*.dob' => ['required', 'string'],
            'adult.*.passport_id' => ['required', 'string'],

            'child' => [$request->nb_child > 0 ? 'required' : 'nullable', 'array', 'max:' . $request->nb_child],
            'child.*.fname' => [$request->nb_child > 0 ? 'required' : 'nullable', 'string'],
            'child.*.lname' => [$request->nb_child > 0 ? 'required' : 'nullable', 'string'],
            'child.*.dob' => [$request->nb_child > 0 ? 'required' : 'nullable', 'string'],
            'child.*.passport_id' => [$request->nb_child > 0 ? 'required' : 'nullable', 'string'],

            'baby' => [$request->nb_baby > 0 ? 'required' : 'nullable', 'array', 'max:' . $request->nb_baby],
            'baby.*.fname' => [$request->nb_baby > 0 ? 'required' : 'nullable', 'string'],
            'baby.*.lname' => [$request->nb_baby > 0 ? 'required' : 'nullable', 'string'],
            'baby.*.dob' => [$request->nb_baby > 0 ? 'required' : 'nullable', 'string'],
            'baby.*.passport_id' => [$request->nb_baby > 0 ? 'required' : 'nullable', 'string'],

            'observation' => ['nullable'],
        ]);

        $booking = $trip->booking()->create([
            'user_uuid' => $request->user()->uuid,
            'ref' => Booking::randomId('ref'),
            'type' => 'trip',
            'date_departure' => $trip->tripDates->where('id', $request->date_id)->first()->date_departure,
            'date_return' => $trip->tripDates->where('id', $request->date_id)->first()->date_return,
            'number_adult' => $request->nb_adult,
            'number_child' => $request->nb_child,
            'number_baby' => $request->nb_baby,
            'beneficiaries' => json_encode([
                'adult' => $request->adult,
                'child' => $request->child,
                'baby' => $request->baby,
            ]),
            'observation' => $request->message,
            'price' => $trip->calculatePrice(['adult' => $request->nb_adult, 'child' => $request->nb_child, 'baby' => $request->nb_baby]),
        ]);

        $bookingTrip = $booking->bookingTrip()->create([
            'formule' => $request->formule,
        ]);

        event(New NewBooking($request->user(), $booking)); //send notif to Admin
        // event(new BookingTrip($request->user(), $booking, $bookingTrip));

        return redirect(route('booking.show', ['ref' => $booking->ref]))->with('status', 'Votre réservation à été effectuer avec succés!');
    }

    public function calculateTripPrice(Request $request) {
        $trip = Trip::where('slug', $request->slug)->firstOrFail();
        $price = $trip->calculatePrice([
            'adult' => $request->countAdult,
            'child' => $request->countChild,
            'baby' => $request->countBaby,
        ]);
        if (!$price) return $this->error(null, 'something wrong', 500);
        return $this->success(['price' => $price], 'successful', 200);
    }

}
