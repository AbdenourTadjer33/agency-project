<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (Auth::check() && !$request->user()->hasVerifiedEmail()) {
            return redirect(route('verification.notice'))->with('status', 'Vueillez confirmer votre adresse email');
        }

        $trips = Trip::orderBy('trip_category_id', 'desc')->orderBy('created_at', 'desc')->with(['hotel:id,name,classification', 'tripDates', 'tripCategory:id,name', 'pricing:id,pricingable_id,pricingable_type,price_adult'])->get();
        $hotels = Hotel::where('slug', '<>', null)->orderBy('created_at', 'desc')->with(['pricing:id,pricingable_id,pricingable_type,price_adult'])->get();
        // dd($hotels);
        return view('welcome', [
            'trips' => $trips,
            'hotels' => $hotels,
        ]);
    }
}
