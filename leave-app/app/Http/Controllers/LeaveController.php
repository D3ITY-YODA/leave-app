<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = LeaveApplication::latest()->get();
        return view('leaves.index', compact('leaves'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:100',
            'leave_type'    => 'required|string',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'reason'        => 'required|string|max:500',
        ]);

        $start = \Carbon\Carbon::parse($request->start_date);
        $end   = \Carbon\Carbon::parse($request->end_date);
        $days  = $start->diffInWeekdays($end) + 1;

        LeaveApplication::create([
            'employee_name' => $request->employee_name,
            'leave_type'    => $request->leave_type,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'days'          => $days,
            'reason'        => $request->reason,
            'status'        => 'Pending',
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave application submitted!');
    }

    public function destroy(LeaveApplication $leaveApplication)
    {
        $leaveApplication->delete();
        return redirect()->route('leaves.index')->with('success', 'Application cancelled.');
    }
}