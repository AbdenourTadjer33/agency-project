<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Agency, AgencyCoordinate, User};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AgencyController extends Controller
{
    public function index()
    {
        return view('admin.agency.index', [
            'agency' => Agency::first(),
            'coordinates' => AgencyCoordinate::all(),
            'admins' => User::where('role', 'admin')->get(),
        ]);
    }

    public function editNetworks()
    {
        return view('admin.agency.edit', [
            'agency' => Agency::first(),
        ]);
    }

    public function updateNetworks(Request $request)
    {

        $request->validate([
            'networks' => ['required', 'array', 'min:1'],
            'networks.*' => ['required', 'url', Rule::in('facebook', 'instagram', 'twitter', 'whatsapp', 'linkedin', 'website')],
        ]);

        Agency::first()->update([
            'networks' => json_encode($request->networks)
        ]);

        return redirect(route('admin.agency'))->with('status', 'les reseau de votre agence son modifier avec succés');
    }

    public function addCoordinates()
    {
        return view('admin.agency.add-coordinates');
    }

    public function storeCoordinates(Request $request)
    {
        $request->validate([
            'name' => ['required', 'UNIQUE:' . AgencyCoordinate::class],
            'country' => ['required'],
            'city' => ['required'],
            'address' => ['required', 'UNIQUE' . AgencyCoordinate::class],
            'coordinates' => ['required', 'array', 'min:2'],
            'coordinates.phone' => ['required', 'string'],
            'coordinates.email' => ['required', 'email'],
        ]);

        $agence = Agency::first()->agencyCoordinates()->create([
            'name' => $request->name,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'coordinates' => json_encode($request->coordinates),
        ]);

        return redirect(route('admin.agency'))->width('status', 'la nouvelle ' . $agence->name . ' est ajoutée avec succés');
    }

    public function editCoordinates(Request $request, $id)
    {
        return view('admin.agency.edit-coordinates', [
            'agencyCoordinates' => AgencyCoordinate::where('id', $id)->first(),
        ]);
    }

    public function updateCoordinates(Request $request, $id)
    {
        $agencyCoordinates = AgencyCoordinate::findOrFail($id);

        $request->validate([
            'name' => ['required', 'unique:agency_coordinates,name,' . $agencyCoordinates->id],
            'country' => ['required'],
            'city' => ['required'],
            'address' => ['required', 'unique:agency_coordinates,address,' . $agencyCoordinates->id],
            'coordinates' => ['required', 'array', 'min:2'],
            'coordinates.phone' => ['required', 'string'],
            'coordinates.email' => ['required', 'email'],
        ]);

        $agencyCoordinates->update([
            'name' => $request->name,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'coordinates' => json_encode($request->coordinates),
        ]);

        return redirect(route('admin.agency'))->with('status', 'les données de ' . $agencyCoordinates->name . ' sont modifier avec succés');
    }

    public function deleteCoordinate(Request $request, $id)
    {
        $agence = AgencyCoordinate::findOrFail($id);
        $agence->delete();
        return redirect(route('admin.agency'))->with('status', $agence->name . ' est suprimmer avec succés!');
    }
}
