<?php

namespace App\Http\Controllers;

use App\Events\BookingHotel;
use App\Models\Hotel;

use App\Models\Booking;
use App\Events\NewBooking;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Validation\Rule;

class HotelController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    public function index()
    {
        return view('hotel.hotels', [
            'hotels' => Hotel::whereNotNull('slug')->get()
        ]);
    }

    public function show($slug)
    {
        return view('hotel.show', [
            'hotel' => Hotel::where('slug', $slug)->with(['pricing'])->first()
        ]);
    }

    public function store(Request $request, $slug)
    {

        $hotel = Hotel::where('slug', $slug)->firstOrFail();

        $request->validate([
            'date_checkin' => ['required', 'date'],
            'date_checkout' => ['required', 'date'],
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

        $booking = $hotel->booking()->create([
            'user_uuid' => $request->user()->uuid,
            'ref' => Booking::randomId('ref'),
            'type' => 'hotel',
            'date_departure' => $request->date_checkin,
            'date_return' => $request->date_checkout,
            'number_adult' => $request->nb_adult,
            'number_child' => $request->nb_child,
            'number_baby' => $request->nb_baby,
            'beneficiaries' => json_encode([
                'adult' => $request->adult,
                'child' => $request->child,
                'baby' => $request->baby,
            ]),
            'observation' => $request->message,
            'price' => $hotel->calculatePrice(['adult' => $request->nb_adult, 'child' => $request->nb_child, 'baby' => $request->nb_baby], $request->formule),
        ]);

        $bookingHotel = $booking->bookingHotel()->create([
            'formule' => $request->formule,
            'type_chambre' => 'Pas de préférence',
        ]);

        event(New NewBooking($request->user(), $booking)); //send notif to Admin
        // event(New BookingHotel($request->user(), $booking, $bookingHotel));

        return redirect(route('booking.show', ['ref' => $booking->ref]))
            ->with('status', 'Votre réservation à été effectuer avec succés!');
    }

    public function calculateHotelPrice(Request $request)
    {
        $hotel = Hotel::where('slug', $request->slug)->firstOrFail();
        $price = $hotel->calculatePrice([
            'adult' => $request->countAdult,
            'child' => $request->countChild,
            'baby' => $request->countBaby,
        ], $request->formule);
        if (!$price) return $this->error(null, 'something wrong', 500);
        return $this->success(['price' => $price], 'successful', 200);
    }
}
