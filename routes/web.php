<?php

use App\Models\Trip;
use App\Models\User;
use App\Models\Hotel;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketingController;
use App\Http\Controllers\TripController as ClientTripController;
use App\Http\Controllers\HotelController as ClientHotelController;

use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\AgencyController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login-temp', function() {
    $user = User::first();
    if (!$user->isAdmin()) {
        $user->roleToAdmin();
    }
    Auth::login($user, true);
    return redirect()->intended();
});

Route::get('/trips', [ClientTripController::class, 'index'])->name('trips');
Route::get('/trip/{slug}', [ClientTripController::class, 'show'])->name('trip.show');
Route::post('/trip/{slug}', [ClientTripController::class, 'store'])->name('trip.store');

Route::get('/hotels', [ClientHotelController::class, 'index'])->name('hotels');
Route::get('/hotels/{slug}', [ClientHotelController::class, 'show'])->name('hotel.show');
Route::post('/hotels/{slug}', [ClientHotelController::class, 'store'])->name('hotel.book');

Route::get('/ticketing', [TicketingController::class, 'create'])->name('ticketing');
Route::post('/ticketing', [TicketingController::class, 'store'])->name('ticketing.store');

Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings');
Route::get('/my-bookings/{ref}', [BookingController::class, 'show'])->name('booking.show');
Route::delete('/my-bookings/delete/{ref}', [BookingController::class, 'delete'])->name('booking.delete');


Route::get('/contact', [ContactController::class, 'create'])->name('contact');



/**
 * ADMIN ROUTES => prefix => /admin
 *  
 *  /dashboard => all data about app and client
 *  
 *  [get] /hotels => all hotels
 *  [get] /hotels/create => view to create new hotel
 *  [post] /hotels => store new hotel
 *  [get] /hotels/{id} => show hotel
 *  [get] /hotels/{id}/update => view to update hotel
 *  [patch] /hotels/{id} => edit hotel
 *  [delete] /hotels/{id} => delete hotel
 *  
 *  [get] /trips => all trips
 *  [get] /trips/create => view to create new trip
 *  [post] /trips => store new trip
 *  [get] /trips/{id} => show trip
 *  [get] /trips/{id}/update => view to update trip
 *  [patch] /trips/{id} => edit trip
 *  [delete] /trips/{id} => delete trip
 * 
 * 
 */
Route::middleware('auth', 'verified', 'role:admin')->prefix('admin')->group(function () {
    // dashboard
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

    // agency management
    Route::controller(AgencyController::class)->group(function () {
        Route::get('/agency', 'index')->name('admin.agency');
        Route::get('/agency/edit-networks', 'editNetworks')->name('admin.agency.edit');
        Route::post('/agency/edit-networks', 'updateNetworks')->name('admin.agency.update');
        Route::get('/agency/add-coordinates', 'addCoordinates')->name('admin.agency.newCoordinates');
        Route::post('/agency/add-coordinates', 'storeCoordinates')->name('admin.agency.storeCoordinates');
        Route::get('/agency/edit-coordinates', 'editCoordinates')->name('admin.agency.editCoordinates');
        Route::post('/agency/edit-coordinates', 'updateCoordinates')->name('admin.agency.updateCoordinates');
        Route::delete('/agency/delete-sub-agence/{id}', 'deleteCoordinate')->name('admin.agency.deleteCoordinates');
    });
    
    // trips
    Route::controller(TripController::class)->group(function () {
        Route::get('/trips', 'index')->name('admin.trips');
        Route::get('/trips/create', 'create')->name('admin.trip.create');
        Route::post('/trips/create', 'store')->name('admin.trip.store');
        Route::get('/trips/{id}', 'show')->name('admin.trip.show');
    });

    // hotel management
    Route::controller(HotelController::class)->group(function () {
        Route::get('/hotels', 'index')->name('admin.hotels');
        Route::get('/hotels/create', 'create')->name('admin.hotel.create');
        Route::post('/hotels/create', 'store')->name('admin.hotel.store');
        Route::get('/hotels/edit/{id}', 'edit')->name('admin.hotel.edit');
        Route::post('/hotels/edit/{id}', 'update')->name('admin.hotel.update');
        Route::get('/hotels/{id}', 'show')->name('admin.hotel.show');
        Route::delete('/hotels/{id}', 'delete')->name('admin.hotel.delete');
    });
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
