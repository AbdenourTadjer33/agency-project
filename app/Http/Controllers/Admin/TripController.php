<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trip;
use App\Models\TripCategorie;
use App\Models\TripDate;
use App\Models\Hotel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    public function index()
    {
        return view('admin.trip.index', [
            'trips' => Trip::all()
        ]);
    }

    public function show($id)
    {
        return view('admin.trip.index', [
            'trips' => Trip::where('id', $id)->get()
        ]);
    }

    public function create()
    {
        return view('admin.trip.create', [
            'categories' => TripCategorie::all(),
            'hotels' => Hotel::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2'],
            'category' => ['required', Rule::exists('trip_categories', 'id')],
            'formule_base' => ['required', Rule::in(['LPD', 'LDP', 'LPC'])],
            'description' => ['required'],
            'destination' => ['required', Rule::notIn('null')],
            'city' => ['required'],
            'dates' => ['required', 'array'],
            'dates.*' => ['required', 'array'],
            'dates.*.departure' => ['required', 'date'],
            'dates.*.return' => ['required', 'date'],
            'price_adult' => ['required'],
            'price_child' => ['required'],
            'price_baby' => ['required'],
            'assets' => ['required', 'array', 'min:1', 'max:10'],
            'assets.*' => ['required', 'image', 'mimes:jpg,svg,png,jpeg', 'max:2048'],
        ]);
        if ($request->get('on_my_hotels') === "on") {
            $hotel = Hotel::findOrfail($request->hotel_id);
        } else {
            $validator = Validator::make($request->all(), [
                'hotel' => ['required', 'array'],
                'hotel.name' => ['required'],
                'hotel.classification' => ['required', 'integer'],
            ], attributes: [
                'hotel' => 'donées d\'hôtel',
                'hotel.name' => 'nom d\'hôtel',
            ]);

            if ($validator->fails()) {
                return redirect((route('admin.trip.create', ['on_my_hotels' => '1'])))
                    ->withErrors($validator)
                    ->withInput();
            }

            $hotel = Hotel::create([
                'name' => $request->hotel['name'],
                'classification' => $request->hotel['classification'],
            ]);

            if (!empty($request->hotel['country'])) {
                $hotel->country = $request->hotel['country'];
            }
            if (!empty($request->hotel['city'])) {
                $hotel->city = $request->hotel['city'];
            }
            if (!empty($request->hotel['address'])) {
                $hotel->address = $request->hotel['address'];
            }
            if (!empty($request->hotel['services'])) {
                $hotel->services = json_encode($request->hotel['services']);
            }
            if (!empty($request->hotel['country']) || !empty($request->hotel['city']) || !empty($request->hotel['address']) || !empty($request->hotel['services'])) {
                $hotel->save();
            }
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
            'city' => $request->city,
            'trip_category_id' => $request->category,
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
        ]);

        return redirect(route('admin.trip.show', ['id' => $trip->id]))->with('status', 'Voyage organisé créer avec succés!');
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

    public function storeCategory(Request $request)
    {
        TripCategorie::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'categoty added successfully',
            'categories' => TripCategorie::all()
        ], 200);
    }
}
