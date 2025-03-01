@extends('layout')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4 display-4 fw-bold text-primary">Trip Details</h2>
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="fas fa-route me-2"></i>
                {{ $trip->pickup_location }} to {{ $trip->destination }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="card-text">
                        <strong><i class="fas fa-clock me-2"></i>Departure:</strong>
                        <span class="text-muted">{{ $trip->departure_time->format('M d, Y H:i') }}</span>
                    </p>
                    <p class="card-text">
                        <strong><i class="fas fa-tag me-2"></i>Price:</strong>
                        <span class="text-success fw-bold">${{ number_format($trip->price, 2) }}</span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="card-text">
                        <strong><i class="fas fa-info-circle me-2"></i>Status:</strong>
                        <span class="badge bg-{{ [
                            'pending' => 'warning',
                            'accepted' => 'success',
                            'canceled' => 'danger',
                            'completed' => 'primary'
                        ][$trip->status] }}">{{ ucfirst($trip->status) }}</span>
                    </p>
                    <p class="card-text">
                        <strong><i class="fas fa-user me-2"></i>Passenger:</strong>
                        <span class="text-muted">{{ auth()->user()->name }}</span>
                    </p>
                </div>
            </div>
        </div>
        @if(auth()->user()->id === $trip->passenger_id)
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-end gap-3">
                    <a href="#" class="btn btn-warning btn-lg">
                        <i class="fas fa-edit me-2"></i> Edit Trip
                    </a>
                    <form action="{{ route('trips.destroy', $trip) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to cancel this trip?')">
                            <i class="fas fa-times me-2"></i> Cancel Trip
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection