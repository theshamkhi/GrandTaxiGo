@extends('layout')

@section('content')
    <h2>Your Availability</h2>
    <a href="{{ route('availability.create') }}" class="btn btn-primary mb-3">Add New Availability</a>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($availabilities as $availability)
                <tr>
                    <td>{{ $availability->start_time->format('M d, Y H:i') }}</td>
                    <td>{{ $availability->end_time->format('M d, Y H:i') }}</td>
                    <td>{{ $availability->location }}</td>
                    <td>
                        <a href="{{ route('availability.edit', $availability) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('availability.destroy', $availability) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection