@extends('layout')

@section('content')
    <h2>Your Trips</h2>    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pickup Location</th>
                    <th>Destination</th>
                    <th>Departure Time</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trips as $trip)
                <tr>
                    <td>{{ $trip->pickup_location }}</td>
                    <td>{{ $trip->destination }}</td>
                    <td>{{ $trip->departure_time->format('M d, Y H:i') }}</td>
                    <td>
                        <span class="badge bg-{{ [
                            'pending' => 'warning',
                            'accepted' => 'success',
                            'canceled' => 'danger',
                            'completed' => 'primary'
                        ][$trip->status] }}">{{ ucfirst($trip->status) }}</span>
                    </td>
                    <td>${{ number_format($trip->price, 2) }}</td>
                    <td>
                        <a href="{{ route('trips.show', $trip) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $trips->links() }}
    </div>

    <h2 class="mt-5">Available Drivers</h2>
    <div class="row">
        @foreach($availableDrivers as $driver)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/' . $driver->profile_photo) }}" alt="{{ $driver->name }}" class="rounded-circle me-3" width="50" height="50">
                        <div>
                            <h5 class="card-title mb-0">{{ $driver->name }}</h5>
                            <small class="text-muted">{{ $driver->phone }}</small>
                        </div>
                    </div>
                    <p class="card-text">
                        <strong>Availability:</strong><br>
                        @foreach($driver->availabilities as $availability)
                            {{ $availability->start_time->format('M d, Y H:i') }} - 
                            {{ $availability->end_time->format('M d, Y H:i') }}<br>
                            <small>{{ $availability->location }}</small><br>
                        @endforeach
                    </p>
                    <a href="{{ route('trips.create', ['driver_id' => $driver->id]) }}" class="btn btn-primary btn-sm">
                        Book This Driver
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection