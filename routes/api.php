<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\TripController;

use App\Http\Controllers\HotelController as ClientHotelController;
use App\Http\Controllers\TripController as ClientTripController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/trip/{slug}/calculate-price', [ClientTripController::class, 'calculateTripPrice']);
Route::post('/hotel/{slug}/calculate-price', [ClientHotelController::class, 'CalculateHotelPrice']);


Route::post('/contact', [ContactController::class, 'store'])->name('contact.post');

// login & verify email api's 
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/verify-email', 'verifyEmail')
        ->middleware('auth:sanctum')
        ->name('verification.code');
});

Route::controller(TripController::class)->prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function (){
    Route::post('/trips/add-category', 'storeCategory')->name('admin.store.category');
});