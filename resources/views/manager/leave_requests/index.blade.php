
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Leave Requests</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Employee</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($leaveRequests as $request)
                <tr>
                    <td>{{ $request->employee->name }}</td>
                    <td>{{ $request->start_date }}</td>
                    <td>{{ $request->end_date }}</td>
                    <td>{{ $request->reason }}</td>
                    <td>{{ $request->status }}</td>
                    <td>
                        <form action="{{ route('manager.leave-requests.update', $request) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit" name="status" value="approved" class="btn btn-success">Approve</button>
                            <button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

