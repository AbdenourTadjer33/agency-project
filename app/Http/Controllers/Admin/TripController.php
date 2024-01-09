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
    public function index(Request $request)
    {
        $trips = Trip::with(['hotel:id,name,classification', 'pricing']);
        $categories = TripCategorie::select('id', 'name')->get()->toArray();
        $categoriesId = array_map(function ($arr) {
            return $arr['id'];
        }, $categories);

        if ($request->category && $request->category != 'all' && in_array($request->category, $categoriesId)) {
            $trips->where('trip_category_id', $request->category);
        }

        if (!$request->order_by) {
            $trips->latest();
        } else {
            $trips->oldest();
        }

        return view('admin.trip.index', [
            'trips' => $trips->paginate($request->pagination > 15 || $request->pagination == null ? 6 : $request->pagination),
            'categories' => $categories
        ]);
    }

    public function show($id)
    {
        return view('admin.trip.index', [
            'trips' => Trip::where('id', $id)->paginate(2),
            'categories' => TripCategorie::select('id', 'name')->get()->toArray(),
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
        $onMyHotelsCond = $request->input('on_my_hotels') == '1' ? true : false; 
        $validator = Validator::make($request->all(), [
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
            'assets.*' => ['required', 'image', 'mimes:jpg,svg,png,jpeg', 'max:4096'],
            'hotel_id' => [$onMyHotelsCond ? 'required' : 'nullable'], // true => required
            'hotel' => [$onMyHotelsCond ? 'nullable' : 'required', 'array'], // true => nullable
            'hotel.name' => [$onMyHotelsCond ? 'nullable' : 'required', 'string'], // true => nullable
            'hotel.classification' => [$onMyHotelsCond ? 'nullable' : 'required', 'integer'], // true => nullable
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.trip.create', ['on_my_hotels' => $onMyHotelsCond ? '1' : '0']))
                ->withErrors($validator)
                ->withInput();
        }

        $assets = $request->file('assets');
        $imgs = [];
        $counter = 1;
        foreach ($assets as $asset) {
            $imgOriginaleName = $asset->getClientOriginalName();
            $imgs[] = [
                'id' => $counter++,
                'path' => $asset->store('trips', 'public'),
                'originalName' => $imgOriginaleName,
                'description' => $request->input(preg_replace('/[^a-zA-Z0-9]/', '', $imgOriginaleName)),
            ];
        }

        if (!$onMyHotelsCond) {
            $hotelID = DB::table('hotels')->insertGetId([
                'name' => $request->hotel['name'],
                'classification' => $request->hotel['classification'],
            ]);
        }

        $trip = Trip::create([
            'name' => $request->name,
            'slug' => Str::slug(Str::random() . ' ' . $request->name),
            'description' => $request->description,
            'destination' => $request->destination,
            'city' => $request->city,
            'trip_category_id' => $request->category,
            'formule_base' => $request->formule_base,
            'assets' => json_encode($imgs),
            'hotel_id' => $onMyHotelsCond ? $request->hotel_id : $hotelID,
        ]);

        foreach ($request->dates as $date) {
            $trip->tripDates()->create([
                'date_departure' => $date['departure'],
                'date_return' => $date['return'],
            ]);
        }

        $trip->pricing()->create([
            'price_adult' => $request->price_adult,
            'price_child' => $request->price_child,
            'price_baby' => $request->price_baby,
        ]);

        return redirect(route('admin.trip.show', ['id' => $trip->id]))->with('status', 'Voyage organisé créer avec succés!');
    }

    public function edit($id)
    {
        $trip = Trip::where('id', $id)->with(['pricing', 'tripDates', 'hotel'])->firstOrFail();

        return view('admin.trip.edit', [
            'trip' => $trip,
            'categories' => TripCategorie::all(),
            'hotels' => Hotel::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $trip = Trip::where('id', $id)->with('hotel', 'pricing', 'tripDates', 'tripCategory')->firstOrFail();

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
            'assets' => ['nullable', 'array', 'min:1', 'max:10'],
            'assets.*' => [$request->assets ? 'required' : 'nullable', 'image', 'mimes:jpg,svg,png,jpeg', 'max:2048'],
        ]);

        if ($request->on_my_hotels) {
            $hotelID = $request->hotel_id;
        } else {
            if ($hotel = DB::table('hotels')->where('name', $request->hotel['name'])->first()) {
                $hotelID = $hotel->id;
            } else {
                $hotelID = DB::table('hotels')->insertGetId([
                    'name' => $request->hotel['name'],
                    'classification' => $request->hotel['classification']
                ]);
            }
        }



        $trip->update([
            'name' => $request->name,
            'slug' => Str::slug(Str::random() . ' ' . $request->name),
            'description' => $request->description,
            'destination' => $request->destination,
            'city' => $request->city,
            'trip_category_id' => $request->category,
            'formule_base' => $request->formule_base,
            'hotel_id' => $hotelID
            // 'assets' => json_encode($paths),
        ]);
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

    public function archiveExpiredTrips(Request $request)
    {
        $trips = Trip::with(['tripDates', 'hotel', 'pricing'])->get();

        $count = 0;
        /**
         * @var Trip $trip
         */
        foreach ($trips as $trip) {
            if ($trip->isExpired()) {
                // archive the trip
                $request->user()->archives()->create([
                    'data' => json_encode([
                        'trip' => $trip,
                        'tripDates' => $trip->tripDates,
                        'pricing' => $trip->pricing
                    ])
                ]);
                $trip->delete();
                $count++;
            }
        }
        return redirect()->back()->with('status', $count . ' voyage' . ($count > 1 ? 's' : '') . ' sont archivé');
    }
}
