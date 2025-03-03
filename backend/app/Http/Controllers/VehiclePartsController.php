<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiclePartsController extends Controller
{
    // Get all vehicle parts
    public function index()
    {
        return response()->json(DB::table('vehicle_parts')->get());
    }

    // Get unique makes
    public function getMakes()
    {
        $makes = DB::table('vehicle_parts')->distinct()->pluck('make');
        return response()->json($makes);
    }

    // Get models based on make
    public function getModels($make)
    {
        $models = DB::table('vehicle_parts')
            ->where('make', $make)
            ->distinct()
            ->pluck('model');

        return response()->json($models);
    }

    // Get types based on make and model
    public function getTypes($make, $model)
    {
        $types = DB::table('vehicle_parts')
            ->where('make', $make)
            ->where('model', $model)
            ->distinct()
            ->pluck('type');

        return response()->json($types);
    }

    // Get parts based on make, model, and type
    public function getParts($make, $model, $type)
    {
        $parts = DB::table('vehicle_parts')
            ->where('make', $make)
            ->where('model', $model)
            ->where('type', $type)
            ->get();

        return response()->json($parts);
    }
}
