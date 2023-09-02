@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Submit a Leave Request</h2>

        <form action="{{ route('leave-request.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Reason for Leave</label>
                <textarea name="reason" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
