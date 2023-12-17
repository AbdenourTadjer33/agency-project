<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trip;
use App\Models\Hotel;
use App\Models\TripDate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return view('admin.trip.create-trip');
    }

    public function store(Request $request)
    {
        // validate incoming data
        $request->validate([
            'name' => ['required', 'min:2'],
            'description' => ['required'],
            'destination' => ['required'],
            'category' => ['required'],
            'formule_base' => ['required', Rule::in(['petit-dej', 'demi-pension', 'pension-complete'])],
            'assets' => ['required', 'array', 'min:1', 'max:10'],
            'assets.*' => ['required', 'image', 'mimes:jpg,svg,png,jpeg', 'max:2048'],
            'dates' => ['required', 'array'],
            'dates.*' => ['required', 'array'],
            'dates.*.departure' => ['required', 'date'],
            'dates.*.return' => ['required', 'date'],
            'price_adult' => ['required'],
            'price_child' => ['required'],
            'price_baby' => ['required'],
            'price_f1' => ['required'],
            'price_f2' => ['required'],
            'price_f3' => ['required'],
        ]);


        if ($request->get('on_my_hotels')) {
            $hotel = Hotel::where('slug', $request->slug)->first();
        } else {
            Validator::make($request->all(), [
                'hotel.name' => ['required'],
                'hotel.country' => ['required'],
                'hotel.city' => ['required'],
                'hotel.address' => ['required'],
                'hotel.classification' => ['required'],
                'hotel.services' => ['required']
            ], attributes: [
                'hotel.name' => 'nom d\'hôtel',
                'hotel.country' => 'pays d\'hotel',
                'hotel.city' => 'pays d\'hôtel',
                'hotel.address' => 'adresse d\'hôtel',
                'hotel.classification' => 'classification d\'hôtel',
                'hotel.services' => 'services d\'hôtel',
            ]);

            $hotel = Hotel::create([
                'name' => $request->hotel['name'],
                'country' => $request->hotel['country'],
                'city' => $request->hotel['city'],
                'address' => $request->hotel['address'],
                'classification' => $request->hotel['classification'],
                'services' => $request->hotel['services']
            ]);
        }

        $assets = $request->file('assets');

        $paths = [];
        for ($i = 0; $i < sizeof($assets); $i++) {
            $paths[] = $assets[$i]->store('public/trips');
        }

        $trip = Trip::create([
            'name' => $request->name,
            'slug' => Str::slug(Str::random() . ' ' . $request->name),
            'description' => $request->description,
            'destination' => $request->destination,
            'category' => $request->category,
            'formule_base' => $request->formule_base,
            'assets' => json_encode($paths),
            'hotel_id' => $hotel->id
        ]);

        foreach ($request->dates as $date) {
            $trip->tripDates()->create([
                'date_departure' => $date['departure'],
                'date_return' => $date['return']
            ]);
        }

        $trip->pricing()->create([
            'price_adult' => $request->price_adult,
            'price_child' => $request->price_child,
            'price_baby' => $request->price_baby,
            'price_f1' => $request->price_f1,
            'price_f2' => $request->price_f2,
            'price_f3' => $request->price_f3,
        ]);
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
