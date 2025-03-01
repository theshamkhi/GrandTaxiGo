@extends('layout')

@section('content')

<form method="POST" action="{{ route('trips.store') }}">
    @csrf

    @if(request()->has('driver_id'))
        <input type="hidden" name="driver_id" value="{{ request('driver_id') }}">
    @endif

    <div class="mb-3">
        <label for="pickup_location" class="form-label">Pickup Location</label>
        <input type="text" class="form-control" id="pickup_location" name="pickup_location" required>
        @error('pickup_location')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="destination" class="form-label">Destination</label>
        <input type="text" class="form-control" id="destination" name="destination" required>
        @error('destination')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="departure_time" class="form-label">Departure Time</label>
        <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" required>
        @error('departure_time')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Book Trip</button>
</form>

@endsection