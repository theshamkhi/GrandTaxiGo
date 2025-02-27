<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'passenger') {
            $reservations = Reservation::where('passengerID', $user->id)->get();
        } else {
            $reservations = Reservation::where('driverID', $user->id)->orWhere('status', 'pending')->get();
        }

        return view('reservations.index', compact('reservations', 'user'));
    }

    public function dashboard()
    {
        if (Auth::user()->role !== 'passenger') {
            abort(403, 'Unauthorized');
        }

        $availableDrivers = DB::table('availabilities')
            ->join('users', 'availabilities.driverID', '=', 'users.id')
            ->where('availabilities.From', '<=', now())
            ->where('availabilities.To', '>=', now())
            ->select('users.id as driverID', 'users.name', 'users.photo', 'users.phone', 'availabilities.From', 'availabilities.To')
            ->get();

        return view('dashboard', compact('availableDrivers'));
    }

    public function create(Request $request)
    {
        if (Auth::user()->role !== 'passenger') {
            abort(403, 'Unauthorized');
        }
    
        $driverID = $request->query('driverID');
        $driver = User::find($driverID);
    
        return view('reservations.create', compact('driver'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'passenger') {
            abort(403, 'Unauthorized');
        }
    
        $data = $request->validate([
            'driverID' => 'required|exists:users,id',
            'deparTime' => 'required|date|after:now',
            'pickupLocation' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
        ]);
    
        $data['passengerID'] = Auth::id();
    
        Reservation::create($data);
    
        return redirect()->route('reservations.index');
    }

    // public function cancel($id)
    // {
    //     $reservation = Reservation::findOrFail($id);

    //     if (Auth::user()->role !== 'passenger' || Auth::id() !== $reservation->passenger_id) {
    //         abort(403, 'Unauthorized');
    //     }

    //     // $departure = Carbon::parse($reservation->departure_time);
    //     // // Ensure the cancellation is done more than 1 hour before departure.
    //     // if (now()->greaterThanOrEqualTo($departure->subHour())) {
    //     //     return redirect()->back()
    //     //         ->with('error', 'Cannot cancel reservation less than one hour before departure.');
    //     // }

    //     $reservation->update(['status' => 'canceled']);

    //     return redirect()->route('reservations.index');
    // }

    // public function updateStatus(Request $request, $id)
    // {
    //     if (Auth::user()->role !== 'driver') {
    //         abort(403, 'Unauthorized');
    //     }

    //     $reservation = Reservation::findOrFail($id);

    //     // Only pending reservations can be updated.
    //     if ($reservation->status !== 'pending') {
    //         return redirect()->back()->with('error', 'Reservation is not pending.');
    //     }

    //     $action = $request->input('action');

    //     if ($action === 'accept') {
    //         $reservation->update([
    //             'driver_id' => Auth::id(),
    //             'status'    => 'accepted',
    //         ]);
    //     } elseif ($action === 'decline') {
    //         $reservation->update(['status' => 'canceled']);
    //     } else {
    //         return redirect()->back()->with('error', 'Invalid action.');
    //     }

    //     return redirect()->route('reservations.index');
    // }
}
