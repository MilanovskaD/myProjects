<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vehicles = Vehicle::all();

        return response()->json([
            'vehicles' => $vehicles
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create-vehicle');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'plate_number' => 'required|unique:vehicles',
            'insurance_date' => 'required|date'
        ]);

        $vehicle = Vehicle::create($validated);

        return response()->json([
            'message' => 'Vehicle created successfully',
            'vehicle' => $vehicle
        ], 201);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return redirect()->back()->with('error', 'Vehicle not found.');
        }

        return view('edit-vehicle', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $vehicle = Vehicle::find($id);


        if (!$vehicle) {
            return response()->json([
                'message' => 'Vehicle not found.'
            ], 404);
        }


        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'plate_number' => 'required|unique:vehicles,plate_number,' . $vehicle->id,  // allow current vehicle's plate number
            'insurance_date' => 'required|date'
        ]);

        $vehicle->update($validated);

        return response()->json([
            'message' => 'Vehicle updated successfully!',
            'vehicle' => $vehicle
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'message' => 'Vehicle not found.'
            ], 404);
        }

        $vehicle->delete();

        return response()->json([
            'message' => 'Vehicle deleted successfully.'
        ], 200);

    }
}
