<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trip;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ReductionController extends Controller
{
    public function index()
    {
        return view('admin.reduction.index', [
            'trip' => ['required', Rule::exists('trips', 'id')],

            'promoCodes' => PromoCode::with('trips:id,name')->get(),
            'trips' => DB::table('trips')->select(['id', 'name'])->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'reduction' => ['required'],
            'trip' => ['required', Rule::exists('trips', 'id')],
            'code' => ['required', 'string', 'max:5'],
        ]);

        $promoCode = PromoCode::create([
            'trip_id' => $request->trip,
            'code' => $request->code,
            'reduction' => $request->reduction,
        ]);

        return redirect()->back()->with('status', 'code de ' . $promoCode->reduction . '% affecté avec succés au voyage ' . $promoCode->trips->name);
    }

    public function update(Request $request)
    {
        $request->validate([
            'reduction' => ['required', 'numeric', 'decimal:2'],
            'trip' => ['required', Rule::exists('trips', 'id')],
            'code' => ['required', 'string', 'max:5'],
        ]);

        PromoCode::where('id', $request->id)->update([
            'trip_id' => $request->trip,
            'code' => $request->code,
            'reduction' => $request->reduction,
        ]);

        return redirect()->back()->with('status', 'Resources modifier avec succés');
    }

    public function destroy(Request $request)
    {
        PromoCode::destroy($request->id);
    }

    public function randomCode()
    {
        return PromoCode::randomCode();
    }
}
