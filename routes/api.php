<?php

use App\Http\Controllers\Admin\TripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


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