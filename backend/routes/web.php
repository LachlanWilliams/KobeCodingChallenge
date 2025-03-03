<?php

use App\Http\Controllers\VehiclePartsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// All the dynamic routes connected to the parts controller

// Get all vehicle parts
Route::get('/parts', [VehiclePartsController::class, 'index']);

// Get makes
Route::get('/makes', [VehiclePartsController::class, 'getMakes']);

// Get models based on make
Route::get('/models/{make}', [VehiclePartsController::class, 'getModels']);

// Get types based on make and model
Route::get('/types/{make}/{model}', [VehiclePartsController::class, 'getTypes']);

// Get parts based on make, model, and type
Route::get('/parts/{make}/{model}/{type}', [VehiclePartsController::class, 'getParts']);