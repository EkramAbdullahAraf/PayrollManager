@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Manage Leave Request</h2>

        <form action="{{ route('leave-request.update', $request->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="pending" @if($request->status == 'pending') selected @endif>Pending</option>
                    <option value="approved" @if($request->status == 'approved') selected @endif>Approve</option>
                    <option value="rejected" @if($request->status == 'rejected') selected @endif>Reject</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
    </div>
@endsection
