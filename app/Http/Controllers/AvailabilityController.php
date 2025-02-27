<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        $availabilities = Availability::where('driver_id', Auth::id())->get();

        return view('availabilities.index', compact('availabilities'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        return view('availabilities.create');
    }

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

        return redirect()->route('availabilities.index');
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        $availability = Availability::where('driver_id', Auth::id())->findOrFail($id);

        return view('availabilities.edit', compact('availability'));
    }

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

        return redirect()->route('availabilities.index');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'driver') {
            abort(403, 'Unauthorized');
        }

        $availability = Availability::where('driver_id', Auth::id())->findOrFail($id);
        $availability->delete();

        return redirect()->route('availabilities.index');
    }
}
