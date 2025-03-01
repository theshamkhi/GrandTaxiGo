@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h2>Your Reservations</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Passenger</th>
                        <th>Pickup Location</th>
                        <th>Destination</th>
                        <th>Departure Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $trip)
                    <tr>
                        <td>{{ $trip->passenger->name }}</td>
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
                        <td>
                            @if($trip->status === 'pending')
                                <form action="{{ route('trips.update-status', $trip) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                </form>
                                
                                <form action="{{ route('trips.update-status', $trip) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="canceled">
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <h2>Your Availability</h2>
            <a href="{{ route('availability.create') }}" class="btn btn-primary mb-3">Add Availability</a>
            <ul class="list-group">
                @foreach($availabilities as $availability)
                <li class="list-group-item">
                    {{ $availability->start_time->format('M d H:i') }} - 
                    {{ $availability->end_time->format('M d H:i') }}
                    <br><small>{{ $availability->location }}</small>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection