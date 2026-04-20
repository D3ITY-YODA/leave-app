<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <style>
        body { background: #f4f6f9; }
        .sidebar { width: 220px; min-height: 100vh; background: #2c3e50; flex-shrink: 0; }
        .sidebar .brand { padding: 20px; font-size: 18px; font-weight: bold; color: #fff; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar a { display: block; padding: 12px 20px; color: rgba(255,255,255,0.75); text-decoration: none; font-size: 14px; }
        .sidebar a:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .sidebar a.active { background: #3498db; color: #fff; }
        .topbar { background: #fff; border-bottom: 1px solid #e0e0e0; padding: 12px 24px; font-size: 14px; color: #555; }
        .balance-card { background: #fff; border-left: 4px solid #3498db; border-radius: 6px; padding: 16px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .balance-card .label { font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 4px; }
        .balance-card .value { font-size: 28px; font-weight: bold; color: #2c3e50; }
        .balance-card .sub { font-size: 12px; color: #aaa; margin-top: 2px; }
        .card { border: 1px solid #e0e0e0; border-radius: 6px; }
        .card-header { background: #f8f9fa; border-bottom: 1px solid #e0e0e0; padding: 14px 20px; font-weight: 600; color: #2c3e50; }
        .badge-annual { background: #ebf5fb; color: #1a6fa8; border: 1px solid #aed6f1; font-weight: 500; }
        .badge-sick   { background: #fdedec; color: #a93226; border: 1px solid #f1948a; font-weight: 500; }
        .badge-casual { background: #fef9e7; color: #9a7d0a; border: 1px solid #f7dc6f; font-weight: 500; }
        .status-Pending  { color: #f39c12; font-weight: 600; }
        .status-Approved { color: #27ae60; font-weight: 600; }
        .status-Rejected { color: #e74c3c; font-weight: 600; }
        table thead th { font-size: 12px; text-transform: uppercase; color: #888; letter-spacing: 0.5px; }
    </style>
</head>
<body>
<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">&#128197; HR System</div>
        <a href="#" class="active">Leave Management</a>
        <a href="#">Dashboard</a>
        <a href="#">My Profile</a>
        <a href="#">Settings</a>
    </div>

    <!-- Main -->
    <div class="flex-grow-1">
        <div class="topbar d-flex justify-content-between">
            <span>Home &rsaquo; <strong>Leave Management</strong></span>
            <span>April 20, 2026</span>
        </div>

        <div class="p-4">

            <!-- Success message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0" style="color:#2c3e50">Leave Management</h4>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#applyModal">
                    + Apply for Leave
                </button>
            </div>

            <!-- Balance cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="balance-card" style="border-color:#3498db">
                        <div class="label">Annual Leave</div>
                        <div class="value">14</div>
                        <div class="sub">of 21 days remaining</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="balance-card" style="border-color:#e74c3c">
                        <div class="label">Medical Leave</div>
                        <div class="value">10</div>
                        <div class="sub">of 14 days remaining</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="balance-card" style="border-color:#f39c12">
                        <div class="label">Casual Leave</div>
                        <div class="value">3</div>
                        <div class="sub">of 7 days remaining</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="balance-card" style="border-color:#27ae60">
                        <div class="label">Total Taken</div>
                        <div class="value">{{ $leaves->where('status', 'Approved')->sum('days') }}</div>
                        <div class="sub">days this year</div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>My Leave Applications</span>
                    <span class="text-muted" style="font-size:13px;font-weight:400">{{ $leaves->count() }} total</span>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Name</th>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Days</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($leaves as $leave)
                            <tr>
                                <td class="ps-3">{{ $loop->iteration }}</td>
                                <td>{{ $leave->employee_name }}</td>
                                <td><span class="badge badge-{{ $leave->leave_type }}">{{ ucfirst($leave->leave_type) }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}</td>
                                <td>{{ $leave->days }}</td>
                                <td style="max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="{{ $leave->reason }}">{{ $leave->reason }}</td>
                                <td><span class="status-{{ $leave->status }}">&#9679; {{ $leave->status }}</span></td>
                                <td>
                                    @if($leave->status === 'Pending')
                                        <form action="{{ route('leaves.destroy', $leave) }}" method="POST" onsubmit="return confirm('Cancel this application?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger py-0 px-2" style="font-size:12px">Cancel</button>
                                        </form>
                                    @else
                                        <span class="text-muted" style="font-size:12px">—</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No leave applications yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Apply Modal -->
<div class="modal fade" id="applyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apply for Leave</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('leaves.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Employee Name <span class="text-danger">*</span></label>
                            <input type="text" name="employee_name" class="form-control" value="{{ old('employee_name') }}" placeholder="Your full name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Leave Type <span class="text-danger">*</span></label>
                            <select name="leave_type" class="form-select" required>
                                <option value="">-- Select --</option>
                                <option value="annual"  {{ old('leave_type') == 'annual'  ? 'selected' : '' }}>Annual Leave</option>
                                <option value="sick"    {{ old('leave_type') == 'sick'    ? 'selected' : '' }}>Medical Leave</option>
                                <option value="casual"  {{ old('leave_type') == 'casual'  ? 'selected' : '' }}>Casual Leave</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required onchange="calcDays()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required onchange="calcDays()">
                        </div>
                        <div class="col-12" id="daysPreview" style="display:none">
                            <div class="alert alert-info py-2 mb-0" style="font-size:14px">
                                Working days requested: <strong id="daysCount">0</strong>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Reason <span class="text-danger">*</span></label>
                            <textarea name="reason" class="form-control" rows="3" placeholder="Briefly describe the reason..." required>{{ old('reason') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
    function calcDays() {
        var start = new Date(document.querySelector('[name=start_date]').value);
        var end   = new Date(document.querySelector('[name=end_date]').value);
        if (!start.getTime() || !end.getTime() || end < start) {
            document.getElementById('daysPreview').style.display = 'none';
            return;
        }
        var count = 0, cur = new Date(start);
        while (cur <= end) {
            var d = cur.getDay();
            if (d !== 0 && d !== 6) count++;
            cur.setDate(cur.getDate() + 1);
        }
        document.getElementById('daysCount').textContent = count;
        document.getElementById('daysPreview').style.display = '';
    }

    // Reopen modal if validation failed
    @if($errors->any())
        var modal = new bootstrap.Modal(document.getElementById('applyModal'));
        modal.show();
    @endif
</script>
</body>
</html>