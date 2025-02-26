<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the driver's availabilities.
     */
    public function index()
    {
        // Only drivers should manage availabilities.
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        $availabilities = Availability::where('driver_id', Auth::id())->get();

        return view('availabilities.index', compact('availabilities'));
    }

    /**
     * Show the form for creating a new availability.
     */
    public function create()
    {
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        return view('availabilities.create');
    }

    /**
     * Store a newly created availability in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'available_from' => 'required|date',
            'available_to'   => 'required|date|after:available_from',
            'location'       => 'nullable|string|max:255',
        ]);

        $data['driver_id'] = Auth::id();

        Availability::create($data);

        return redirect()->route('availabilities.index')
                         ->with('success', 'Availability created successfully.');
    }

    /**
     * Show the form for editing the specified availability.
     */
    public function edit($id)
    {
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        $availability = Availability::where('driver_id', Auth::id())->findOrFail($id);

        return view('availabilities.edit', compact('availability'));
    }

    /**
     * Update the specified availability in storage.
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        $availability = Availability::where('driver_id', Auth::id())->findOrFail($id);

        $data = $request->validate([
            'available_from' => 'required|date',
            'available_to'   => 'required|date|after:available_from',
            'location'       => 'nullable|string|max:255',
        ]);

        $availability->update($data);

        return redirect()->route('availabilities.index')
                         ->with('success', 'Availability updated successfully.');
    }

    /**
     * Remove the specified availability from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        $availability = Availability::where('driver_id', Auth::id())->findOrFail($id);
        $availability->delete();

        return redirect()->route('availabilities.index')
                         ->with('success', 'Availability deleted successfully.');
    }
}
