<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $leaves   = LeaveApplication::latest()->get();
        $pending  = $leaves->where('status', 'Pending')->count();
        $approved = $leaves->where('status', 'Approved')->count();
        $rejected = $leaves->where('status', 'Rejected')->count();
        return view('admin.index', compact('leaves', 'pending', 'approved', 'rejected'));
    }

    public function approve(LeaveApplication $leaveApplication)
    {
        $leaveApplication->update(['status' => 'Approved']);
        return redirect()->route('admin.index')->with('success', 'Leave approved successfully.');
    }

    public function reject(LeaveApplication $leaveApplication)
    {
        $leaveApplication->update(['status' => 'Rejected']);
        return redirect()->route('admin.index')->with('success', 'Leave rejected.');
    }
}