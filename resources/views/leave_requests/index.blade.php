@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Leave Requests</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Employee</th>
                <th>Reason</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                @if(auth()->user()->role == 'manager') <!-- assuming you've implemented roles -->
                <th>Actions</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($leave_requests as $request)
                <tr>
                    <td>{{ $request->employee->name }}</td>
                    <td>{{ $request->reason }}</td>
                    <td>{{ $request->start_date }}</td>
                    <td>{{ $request->end_date }}</td>
                    <td>{{ $request->status }}</td>
                    @if(auth()->user()->role == 'manager')
                        <td>
                            <a href="{{ route('leave-request.edit', $request->id) }}" class="btn btn-primary">Manage</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
