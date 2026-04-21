<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <style>
        * { box-sizing: border-box; }
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }

        /* Sidebar */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1a2942 0%, #243655 100%);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar .brand {
            padding: 24px 20px;
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            letter-spacing: 0.3px;
        }
        .sidebar .brand small {
            display: block;
            font-size: 11px;
            font-weight: 400;
            color: rgba(255,255,255,0.4);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 2px;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 20px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.15s;
            margin: 2px 8px;
            border-radius: 8px;
        }
        .sidebar a:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .sidebar a.active { background: #3b82f6; color: #fff; }
        .sidebar-nav { padding: 12px 0; flex: 1; }
        .nav-section {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.25);
            padding: 12px 20px 4px;
        }
        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .user-info { display: flex; align-items: center; gap: 10px; }
        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: #3b82f6;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .user-name { font-size: 13px; font-weight: 500; color: #fff; }
        .user-role { font-size: 11px; color: rgba(255,255,255,0.4); }

        /* Topbar */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 28px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .breadcrumb-text { font-size: 14px; color: #6b7280; }
        .breadcrumb-text strong { color: #111827; }

        /* Page content */
        .content { padding: 28px; }

        /* Hero banner */
        .hero-banner {
            background: linear-gradient(135deg, #1a2942 0%, #2563eb 100%);
            border-radius: 12px;
            padding: 28px 32px;
            color: #fff;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }
        .hero-banner::after {
            content: '📅';
            position: absolute;
            right: 32px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 64px;
            opacity: 0.15;
        }
        .hero-banner h5 { font-size: 20px; font-weight: 700; margin-bottom: 4px; }
        .hero-banner p { font-size: 14px; color: rgba(255,255,255,0.7); margin: 0; }

        /* Balance cards */
        .balance-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.07);
            border: 1px solid #e5e7eb;
            height: 100%;
        }
        .balance-card .icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            margin-bottom: 12px;
        }
        .balance-card .label { font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .balance-card .value { font-size: 30px; font-weight: 700; color: #111827; line-height: 1; margin-bottom: 4px; }
        .balance-card .sub { font-size: 12px; color: #9ca3af; margin-bottom: 12px; }
        .balance-card .progress { height: 5px; border-radius: 99px; background: #f3f4f6; }

        /* Main card */
        .main-card {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .main-card .card-top {
            padding: 18px 24px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .main-card .card-top h6 { font-weight: 600; color: #111827; margin: 0; font-size: 15px; }

        /* Table */
        table thead th {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #9ca3af;
            font-weight: 600;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb !important;
            padding: 12px 16px;
        }
        table tbody td { padding: 14px 16px; font-size: 14px; color: #374151; vertical-align: middle; border-color: #f3f4f6; }
        table tbody tr:hover { background: #f9fafb; }

        /* Type badges */
        .type-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .type-annual  { background: #dbeafe; color: #1d4ed8; }
        .type-sick    { background: #fee2e2; color: #b91c1c; }
        .type-casual  { background: #fef9c3; color: #a16207; }

        /* Status */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-pill .dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
        .pill-pending  { background: #fffbeb; color: #d97706; }
        .pill-pending .dot  { background: #d97706; }
        .pill-approved { background: #f0fdf4; color: #16a34a; }
        .pill-approved .dot { background: #16a34a; }
        .pill-rejected { background: #fef2f2; color: #dc2626; }
        .pill-rejected .dot { background: #dc2626; }

        /* Form */
        .form-label { font-size: 13px; font-weight: 500; color: #374151; }
        .form-control, .form-select {
            border-color: #e5e7eb;
            font-size: 14px;
            border-radius: 8px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }
        .modal-header { background: #f9fafb; border-bottom: 1px solid #e5e7eb; }
        .modal-content { border-radius: 12px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }

        .btn-primary { background: #2563eb; border-color: #2563eb; border-radius: 8px; font-size: 14px; }
        .btn-primary:hover { background: #1d4ed8; border-color: #1d4ed8; }
        .btn-outline-danger { border-radius: 6px; font-size: 12px; }

        .days-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            color: #1d4ed8;
        }

        .empty-state { padding: 60px 20px; text-align: center; color: #9ca3af; }
        .empty-state .icon { font-size: 48px; margin-bottom: 12px; }

        .alert-notice {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            color: #92400e;
            margin-bottom: 24px;
        }
    </style>
</head>
<body>
<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            &#128197; HR Portal
            <small>Leave Management</small>
        </div>
        <div class="sidebar-nav">
            <div class="nav-section">Menu</div>
            <a href="#">&#127968; Dashboard</a>
            <a href="#" class="active">&#128197; Leave</a>
            <a href="#">&#128100; My Profile</a>
            <a href="#">&#128202; Reports</a>
            <div class="nav-section" style="margin-top:8px">System</div>
            <a href="#">&#9881;&#65039; Settings</a>
        </div>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">JM</div>
                <div>
                    <div class="user-name">James Mwangi</div>
                    <div class="user-role">Software Engineer</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main -->
    <div class="flex-grow-1" style="min-width:0">
        <div class="topbar">
            <div class="breadcrumb-text">Home &rsaquo; <strong>Leave Management</strong></div>
            <div class="d-flex align-items-center gap-3">
                <span style="font-size:13px;color:#6b7280">{{ now()->format('D, d M Y') }}</span>
                <button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#applyModal">
                    + Apply for Leave
                </button>
            </div>
        </div>

        <div class="content">

            <!-- Success alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                    ✅ &nbsp;{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Hero -->
            <div class="hero-banner mb-4">
                <h5>Welcome back, James 👋</h5>
                <p>You have <strong>{{ $leaves->where('status', 'Pending')->count() }} pending</strong> application(s) and <strong>14 annual leave days</strong> remaining this year.</p>
            </div>

            <!-- Notice -->
            <div class="alert-notice">
                ⚠️ &nbsp;Leave applications must be submitted at least <strong>3 working days</strong> in advance.
            </div>

            <!-- Balance Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="balance-card">
                        <div class="icon" style="background:#dbeafe">🏖️</div>
                        <div class="label">Annual Leave</div>
                        <div class="value">14</div>
                        <div class="sub">of 21 days remaining</div>
                        <div class="progress"><div class="progress-bar" style="width:66%;background:#3b82f6"></div></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="balance-card">
                        <div class="icon" style="background:#fee2e2">🏥</div>
                        <div class="label">Medical Leave</div>
                        <div class="value">10</div>
                        <div class="sub">of 14 days remaining</div>
                        <div class="progress"><div class="progress-bar" style="width:71%;background:#ef4444"></div></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="balance-card">
                        <div class="icon" style="background:#fef9c3">☀️</div>
                        <div class="label">Casual Leave</div>
                        <div class="value">3</div>
                        <div class="sub">of 7 days remaining</div>
                        <div class="progress"><div class="progress-bar" style="width:43%;background:#eab308"></div></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="balance-card">
                        <div class="icon" style="background:#dcfce7">📊</div>
                        <div class="label">Total Taken</div>
                        <div class="value">{{ $leaves->where('status', 'Approved')->sum('days') }}</div>
                        <div class="sub">approved days this year</div>
                        <div class="progress"><div class="progress-bar" style="width:{{ min(($leaves->where('status','Approved')->sum('days') / 21) * 100, 100) }}%;background:#22c55e"></div></div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="main-card">
                <div class="card-top">
                    <h6>My Leave Applications</h6>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-secondary border" style="font-size:12px">{{ $leaves->count() }} total</span>
                        <select class="form-select form-select-sm" style="width:auto;font-size:13px" id="statusFilter" onchange="filterTable()">
                            <option value="">All Status</option>
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Type</th>
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
                            <tr data-status="{{ $leave->status }}">
                                <td style="color:#9ca3af">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width:30px;height:30px;border-radius:50%;background:#dbeafe;color:#1d4ed8;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                            {{ strtoupper(substr($leave->employee_name, 0, 2)) }}
                                        </div>
                                        <span>{{ $leave->employee_name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="type-badge type-{{ $leave->leave_type }}">{{ ucfirst($leave->leave_type) }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}</td>
                                <td><strong>{{ $leave->days }}</strong></td>
                                <td style="max-width:150px">
                                    <span style="display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#6b7280" title="{{ $leave->reason }}">
                                        {{ $leave->reason }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-pill pill-{{ strtolower($leave->status) }}">
                                        <span class="dot"></span>
                                        {{ $leave->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($leave->status === 'Pending')
                                        <form action="{{ route('leaves.destroy', $leave) }}" method="POST" onsubmit="return confirm('Cancel this application?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger py-0 px-2">Cancel</button>
                                        </form>
                                    @else
                                        <span style="color:#d1d5db">—</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <div class="icon">📭</div>
                                        <div style="font-weight:500;color:#374151;margin-bottom:4px">No applications yet</div>
                                        <div style="font-size:13px">Click <strong>Apply for Leave</strong> to submit your first request.</div>
                                    </div>
                                </td>
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
            <div class="modal-header px-4">
                <h5 class="modal-title fw-600">📝 Apply for Leave</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('leaves.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li style="font-size:14px">{{ $error }}</li>
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
                                <option value="">-- Select type --</option>
                                <option value="annual"  {{ old('leave_type') == 'annual'  ? 'selected' : '' }}>Annual Leave (14 days left)</option>
                                <option value="sick"    {{ old('leave_type') == 'sick'    ? 'selected' : '' }}>Medical Leave (10 days left)</option>
                                <option value="casual"  {{ old('leave_type') == 'casual'  ? 'selected' : '' }}>Casual Leave (3 days left)</option>
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
                            <div class="days-info">
                                📅 &nbsp;Working days requested: <strong id="daysCount">0</strong> day(s) — weekends excluded
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Reason <span class="text-danger">*</span></label>
                            <textarea name="reason" class="form-control" rows="3" placeholder="Briefly describe the reason for your leave..." required>{{ old('reason') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4" style="background:#f9fafb;border-top:1px solid #e5e7eb">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Submit Application</button>
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
        var preview = document.getElementById('daysPreview');
        if (!start.getTime() || !end.getTime() || end < start) {
            preview.style.display = 'none';
            return;
        }
        var count = 0, cur = new Date(start);
        while (cur <= end) {
            if (cur.getDay() !== 0 && cur.getDay() !== 6) count++;
            cur.setDate(cur.getDate() + 1);
        }
        document.getElementById('daysCount').textContent = count;
        preview.style.display = '';
    }

    function filterTable() {
        var val = document.getElementById('statusFilter').value;
        document.querySelectorAll('tbody tr[data-status]').forEach(function(row) {
            row.style.display = (!val || row.dataset.status === val) ? '' : 'none';
        });
    }

    @if($errors->any())
        new bootstrap.Modal(document.getElementById('applyModal')).show();
    @endif
</script>
</body>
</html>