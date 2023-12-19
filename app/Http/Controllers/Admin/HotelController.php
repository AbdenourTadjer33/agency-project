<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\Paginator;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    public function index()
    {
        return view('admin.hotel.manage-hotels', [
            'hotels' => Hotel::all(),
        ]);
    }

    public function create()
    {
        return view('admin.hotel.create-hotel');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'min:2', 'unique:' . Hotel::class],
            'description' => ['required', 'min:10'],
            'country' => ['required'],
            'city' => ['required'],
            'address' => ['required', 'min:5'],
            'nb_rooms' => ['required', 'integer'],
            'coordinates' => ['required', 'array'],
            'coordinates.phone' => ['required'],
            'coordinates.phone_code' => ['required'],
            'coordinates.email' => ['required', 'string', 'email'],
            'coordinates.website' => ['nullable', 'url'],
            'coordinates.facebook' => ['nullable', 'url'],
            'coordinates.instagram' => ['nullable', 'url'],
            'coordinates.booking' => ['nullable', 'url'],
            'classification' => ['required', 'integer'],
            'services' => ['required', 'array'],
            'assets' => ['required', 'array', 'min:1', 'max:10'],
            'assets.*' => ['required', 'image', 'mimes:jpg,svg,png,jpeg', 'max:4096'],
            'price_adult' => ['required'],
            'price_child' => ['required'],
            'price_baby' => ['required'],
            'price_f1' => ['required'],
            'price_f2' => ['required'],
            'price_f3' => ['required'],
        ]);

        $assets = $request->file('assets');

        $paths = [];
        for ($i = 0; $i < sizeof($assets); $i++) {
            $paths[] = $assets[$i]->store('public/hotels');
        }

        $hotel = Hotel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'coordinates' => json_encode($request->coordinates),
            'classification' => $request->classification,
            'number_rooms' => $request->nb_rooms,
            'services' => json_encode($request->services),
            'assets' => json_encode($paths),
        ]);

        $hotel->pricing()->create([
            'price_adult' => $request->price_adult,
            'price_child' => $request->price_child,
            'price_baby' => $request->price_baby,
            'price_f1' => $request->price_f1,
            'price_f2' => $request->price_f2,
            'price_f3' => $request->price_f3,
        ]);

        return redirect(route('admin.hotel.show', ['id' => $hotel->id]))->with('status', 'Hôtel créer avec succés');
    }

    public function show($id)
    {
        return view('admin.hotel.manage-hotels', [
            'hotels' => Hotel::where('id', $id)->get()
        ]);
    }

    public function edit($id)
    {
        return view('admin.hotel.edit-hotel', [
            'hotel' => Hotel::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $request->validate([
            'name' => ['required', 'min:2', 'unique:hotels,name,' . $hotel->id],
            'description' => ['required', 'min:10'],
            'country' => ['required'],
            'city' => ['required'],
            'address' => ['required', 'min:5'],
            'coordinates' => ['required', 'array'],
            'coordinates.phone' => ['required'],
            'coordinates.phone_code' => ['required'],
            'coordinates.email' => ['required', 'string', 'email'],
            'coordinates.website' => ['nullable', 'url'],
            'coordinates.facebook' => ['nullable', 'url'],
            'coordinates.instagram' => ['nullable', 'url'],
            'coordinates.booking' => ['nullable', 'url'],
            'rating' => ['required', 'integer'],
            'nb_rooms' => ['required', 'integer'],
            'services' => ['required'],
            'price_adult' => ['required'],
            'price_child' => ['required'],
            'price_baby' => ['required'],
            'price_f1' => ['required'],
            'price_f2' => ['required'],
            'price_f3' => ['required'],
        ]);

        $hotel->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'coordinates' => json_encode($request->coordinates),
            'classification' => $request->rating,
            'number_rooms' => $request->nb_rooms,
            'services' => json_encode(explode(',', $request->services))
        ]);

        $hotel->pricing()->update([
            'price_adult' => $request->price_adult,
            'price_child' => $request->price_child,
            'price_baby' => $request->price_baby,
            'price_f1' => $request->price_f1,
            'price_f2' => $request->price_f2,
            'price_f3' => $request->price_f3,
        ]);

        return redirect(route('admin.hotel.show', ['id' => $hotel->id]))->with('status', $hotel->name . 'modifier avec succés');
    }

    public function editAssets($id)
    {
        return view('admin.hotel.edit-hotel-assets', [
            'hotel' => Hotel::findOrFail($id)
        ]);
    }

    public function updateAssets(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $request->validate([
            'assets' => ['required', 'array', 'min:1', 'max:10'],
            'assets.*' => ['required', 'image', 'mimes:jpg,svg,png,jpeg', 'max:2048']
        ]);

        // Storage::disk('public')
    }

    public function delete($id)
    {
        Hotel::where('id', $id)->first()->delete();
        return redirect(route('admin.hotels'))->with('status', 'Hôtel supprimer avec succés');
    }
}
