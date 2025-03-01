@extends('layout')

@section('content')
    <h2>{{ isset($availability) ? 'Edit' : 'Create' }} Availability</h2>
    <form method="POST" action="{{ isset($availability) ? route('availability.update', $availability) : route('availability.store') }}">
        @csrf
        @if(isset($availability))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" 
                   value="{{ isset($availability) ? $availability->start_time->format('Y-m-d\TH:i') : old('start_time') }}" required>
            @error('start_time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" 
                   value="{{ isset($availability) ? $availability->end_time->format('Y-m-d\TH:i') : old('end_time') }}" required>
            @error('end_time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" 
                   value="{{ isset($availability) ? $availability->location : old('location') }}" required>
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($availability) ? 'Update' : 'Create' }}</button>
    </form>
@endsection