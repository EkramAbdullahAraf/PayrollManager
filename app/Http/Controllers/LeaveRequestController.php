<?php

namespace App\Http\Controllers;
use App\Notifications\LeaveStatusUpdated;



use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'manager') {
            $requests = LeaveRequest::all();
        } else {
            $requests = auth()->user()->leaveRequests;
        }

        return view('leave_requests.index', ['requests' => $requests]);
    }
    public function create()
    {
        return view('leave_requests.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $leaveRequest = new LeaveRequest();
        $leaveRequest->employee_id = auth()->user()->id;
        $leaveRequest->reason = $request->input('reason');
        $leaveRequest->start_date = $request->input('start_date');
        $leaveRequest->end_date = $request->input('end_date');
        $leaveRequest->save();

        return redirect()->route('leave-request.index')->with('success', 'Leave request submitted successfully.');
        $user->notify(new LeaveStatusUpdated($leaveRequest));
    }
    public function edit(LeaveRequest $leaveRequest)
    {
        if (auth()->user()->role != 'manager' && auth()->user()->id != $leaveRequest->employee_id) {
            return redirect()->back()->with('error', 'Access Denied.');

        }

        return view('leave_requests.edit', ['request' => $leaveRequest]);
        $user->notify(new LeaveStatusUpdated($leaveRequest));
    }
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        if (auth()->user()->role != 'manager') {
            return redirect()->back()->with('error', 'Only managers can approve or reject requests.');
        }
        if ($request->input('status') === 'approved' && $leaveRequest->status !== 'approved') {
            // Calculate days of leave
            $daysRequested = $leaveRequest->start_date->diffInDays($leaveRequest->end_date) + 1;

            // Deduct from employee's leave balance
            $leaveRequest->employee->decrement('leave_balance', $daysRequested);
        }
        $request->validate([
            'status' => 'required|in:approved,rejected,pending'
        ]);

        $leaveRequest->status = $request->input('status');
        $leaveRequest->save();

        return redirect()->route('leave-request.index')->with('success', 'Leave request updated successfully.');
    }

}
