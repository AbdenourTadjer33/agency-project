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
    public function index(Request $request)
    {
        return view('admin.hotel.index', [
            'hotels' => Hotel::where('slug', '<>', null)->with(['pricing'])->paginate($request->pagination > 15 || $request->pagination == null ? 6 : $request->pagination),
        ]);
    }

    public function create()
    {
        return view('admin.hotel.create');
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
        $imgs = [];
        $counter = 1;
        foreach ($assets as $asset) {
            $imgOriginaleName = $asset->getClientOriginalName();
            $imgs[] = [
                'id' => $counter++,
                'path' => $asset->store('hotels', 'public'),
                'originalName' => $imgOriginaleName,
                'description' => $request->input(preg_replace('/[^a-zA-Z0-9]/', '', $imgOriginaleName)),
            ];
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
            'assets' => json_encode($imgs),
        ]);

        $hotel->pricing()->create([
            'price_adult' => $request->price_adult,
            'price_child' => $request->price_child,
            'price_baby' => $request->price_baby,
            'price_lpd' => $request->price_f1,
            'price_ldp' => $request->price_f2,
            'price_lpc' => $request->price_f3,
        ]);

        return redirect(route('admin.hotel.show', ['id' => $hotel->id]))->with('status', 'Hôtel créer avec succés');
    }

    public function show($id)
    {
        return view('admin.hotel.show', [
            'hotel' => Hotel::where('id', $id)->firstOrFail()
        ]);
    }

    public function edit($id)
    {
        return view('admin.hotel.edit', [
            'hotel' => Hotel::with('pricing')->findOrFail($id)
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

    public function delete($id)
    {
        Hotel::where('id', $id)->first()->delete();
        return redirect(route('admin.hotels'))->with('status', 'Hôtel supprimer avec succés');
    }
}
