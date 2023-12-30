<?php

namespace App\Http\Controllers;

use App\Events\BookingTicketing;
use App\Events\NewBooking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Booking;

class TicketingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }
    
    public function create()
    {
        return view('ticketing');
    }

    public function store(Request $request)
    {
        $request->validate([
            'flight_type' => ['required', Rule::in(['AR', 'AS'])],
            'only_departure' => [$request->flight_type == 'AS' ? 'required' : 'nullable', 'date'],
            'date_departure' => [$request->flight_type == 'AR' ? 'required' : 'nullable', 'date'],
            'date_return' => [$request->flight_type == 'AR' ? 'required' : 'nullable', 'date'],
            'airport_departure' => ['required'],
            'airport_arrived' => ['required'],
            'class' => ['required', Rule::in(['Pas de préférence', 'Economie', 'Affaires', 'Première'])],
            'compagnie' => ['required', Rule::in(['Pas de préférence', 'Air Algérie', 'Tunisair', 'Royal Air Maroc', 'Turkish Airlines'])],
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
            
            'message' => ['nullable'],
        ]);


        $booking = $request->user()->bookings()->create([
            'ref' => Booking::randomId('ref'),
            'type' => 'ticketing',
            'date_departure' => $request->flight_type === 'AS' ? $request->only_departure : $request->date_departure,
            'date_return' => $request->flight_type === 'AS' ? null : $request->date_return,
            'number_adult' => $request->nb_adult,
            'number_child' => $request->nb_child,
            'number_baby' => $request->nb_baby,
            'beneficiaries' => json_encode([
                'adult' => $request->adult,
                'child' => $request->child,
                'baby' => $request->baby,
            ]),
            'observation' => $request->message,
        ]);
        
        $bookingTicketing = $booking->ticketing()->create([
            'flight_type' => $request->flight_type,
            'airport_departure' => $request->airport_departure,
            'airport_arrived' => $request->airport_arrived,
            'compagnie' => $request->compagnie,
            'class' => $request->class,
        ]);


        event(New NewBooking($request->user, $booking)); //send notif to Admin
        event(New BookingTicketing($request->user(), $booking, $bookingTicketing)); // send email to user that contains booking informations

        return redirect(route('booking.show', ['ref' => $booking->ref]))->with('status', 'Votre demande de billet à été effectuer avec succés.');
    }
}
