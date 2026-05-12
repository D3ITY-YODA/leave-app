<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <style>
        * { box-sizing: border-box; }

        body {
            background: #0a0a0f;
            font-family: 'Segoe UI', sans-serif;
            color: #e2e8f0;
        }

        /* RGB animated background */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background:
                radial-gradient(ellipse at 10% 20%, rgba(120, 40, 255, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 90% 80%, rgba(0, 200, 255, 0.12) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(255, 40, 120, 0.08) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .layout { display: flex; min-height: 100vh; position: relative; z-index: 1; }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: rgba(15, 15, 25, 0.95);
            border-right: 1px solid rgba(255,255,255,0.06);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            backdrop-filter: blur(10px);
        }

        .brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .brand-name {
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(90deg, #a855f7, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-sub {
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-top: 2px;
        }

        .sidebar-nav { padding: 16px 10px; flex: 1; }

        .nav-section {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.2);
            padding: 10px 12px 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 2px;
            transition: all 0.2s;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(168,85,247,0.3), rgba(59,130,246,0.3));
            color: #fff;
            border: 1px solid rgba(168,85,247,0.3);
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a855f7, #3b82f6);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .user-name { font-size: 13px; font-weight: 600; color: #fff; }
        .user-role { font-size: 11px; color: rgba(255,255,255,0.35); }

        /* Topbar */
        .topbar {
            background: rgba(15,15,25,0.9);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 0 28px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .breadcrumb-text { font-size: 14px; color: rgba(255,255,255,0.4); }
        .breadcrumb-text strong { color: #fff; }

        .btn-apply {
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            background: linear-gradient(135deg, #a855f7, #3b82f6);
            color: #fff;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn-apply:hover { opacity: 0.85; }

        /* Content */
        .content { padding: 28px; }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, rgba(168,85,247,0.2), rgba(59,130,246,0.2), rgba(6,182,212,0.15));
            border: 1px solid rgba(168,85,247,0.25);
            border-radius: 14px;
            padding: 28px 32px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%; right: -10%;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(168,85,247,0.2), transparent 70%);
            pointer-events: none;
        }

        .hero h5 { font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 6px; }
        .hero p { font-size: 14px; color: rgba(255,255,255,0.6); margin: 0; }
        .hero strong { color: #a855f7; }

        /* Notice */
        .notice {
            background: rgba(234,179,8,0.1);
            border: 1px solid rgba(234,179,8,0.25);
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            color: #fbbf24;
            margin-bottom: 24px;
        }

        /* Balance cards */
        .balance-card {
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(255,255,255,0.07);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .balance-card::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 80px; height: 80px;
            border-radius: 50%;
            opacity: 0.15;
            transform: translate(20px, -20px);
        }

        .card-annual { background: linear-gradient(135deg, rgba(168,85,247,0.15), rgba(168,85,247,0.05)); }
        .card-annual::after { background: #a855f7; }
        .card-sick   { background: linear-gradient(135deg, rgba(239,68,68,0.15), rgba(239,68,68,0.05)); }
        .card-sick::after   { background: #ef4444; }
        .card-casual { background: linear-gradient(135deg, rgba(234,179,8,0.15), rgba(234,179,8,0.05)); }
        .card-casual::after { background: #eab308; }
        .card-total  { background: linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.05)); }
        .card-total::after  { background: #22c55e; }

        .card-icon { font-size: 24px; margin-bottom: 12px; display: block; }
        .card-label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); margin-bottom: 4px; }
        .card-value { font-size: 32px; font-weight: 700; color: #fff; line-height: 1; margin-bottom: 4px; }
        .card-sub { font-size: 12px; color: rgba(255,255,255,0.35); margin-bottom: 12px; }

        .progress-bar-wrap {
            height: 4px;
            background: rgba(255,255,255,0.08);
            border-radius: 99px;
            overflow: hidden;
        }

        .progress-bar-fill { height: 100%; border-radius: 99px; }
        .fill-purple { background: linear-gradient(90deg, #a855f7, #7c3aed); }
        .fill-red    { background: linear-gradient(90deg, #ef4444, #dc2626); }
        .fill-yellow { background: linear-gradient(90deg, #eab308, #ca8a04); }
        .fill-green  { background: linear-gradient(90deg, #22c55e, #16a34a); }

        /* Main table card */
        .table-card {
            background: rgba(15,15,25,0.8);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 12px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .table-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-card-header h6 { color: #fff; font-weight: 600; margin: 0; font-size: 15px; }

        .form-select {
            background-color: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: #e2e8f0;
            font-size: 13px;
            border-radius: 8px;
        }

        .form-select:focus {
            background-color: rgba(255,255,255,0.08);
            border-color: #a855f7;
            box-shadow: 0 0 0 3px rgba(168,85,247,0.2);
            color: #fff;
        }

        .form-select option { background: #1a1a2e; color: #e2e8f0; }

        table { width: 100%; border-collapse: collapse; }

        thead th {
            padding: 12px 16px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.02);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            font-weight: 600;
        }

        tbody td {
            padding: 14px 16px;
            font-size: 14px;
            color: rgba(255,255,255,0.75);
            border-bottom: 1px solid rgba(255,255,255,0.04);
            vertical-align: middle;
        }

        tbody tr:hover td { background: rgba(255,255,255,0.03); }
        tbody tr:last-child td { border-bottom: none; }

        /* Type badges */
        .type-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .type-annual { background: rgba(168,85,247,0.2); color: #c084fc; border: 1px solid rgba(168,85,247,0.3); }
        .type-sick   { background: rgba(239,68,68,0.2);  color: #f87171; border: 1px solid rgba(239,68,68,0.3); }
        .type-casual { background: rgba(234,179,8,0.2);  color: #fbbf24; border: 1px solid rgba(234,179,8,0.3); }

        /* Status pills */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }

        .pill-pending  { background: rgba(234,179,8,0.15);  color: #fbbf24; border: 1px solid rgba(234,179,8,0.25); }
        .pill-pending .dot  { background: #fbbf24; }
        .pill-approved { background: rgba(34,197,94,0.15);  color: #4ade80; border: 1px solid rgba(34,197,94,0.25); }
        .pill-approved .dot { background: #4ade80; }
        .pill-rejected { background: rgba(239,68,68,0.15);  color: #f87171; border: 1px solid rgba(239,68,68,0.25); }
        .pill-rejected .dot { background: #f87171; }

        /* Avatar initials */
        .emp-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a855f7, #3b82f6);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        /* Cancel button */
        .btn-cancel {
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 12px;
            border: 1px solid rgba(239,68,68,0.4);
            background: rgba(239,68,68,0.1);
            color: #f87171;
            cursor: pointer;
            transition: all 0.15s;
        }
        .btn-cancel:hover { background: rgba(239,68,68,0.25); color: #fca5a5; }

        /* Empty state */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: rgba(255,255,255,0.25);
        }
        .empty-state .icon { font-size: 48px; margin-bottom: 12px; }

        /* Alert */
        .alert-success-custom {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.25);
            color: #4ade80;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Modal */
        .modal-content {
            background: #0f0f1a;
            border: 1px solid rgba(168,85,247,0.25);
            border-radius: 14px;
            color: #e2e8f0;
        }

        .modal-header {
            background: linear-gradient(135deg, rgba(168,85,247,0.15), rgba(59,130,246,0.1));
            border-bottom: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px 14px 0 0;
            padding: 18px 24px;
        }

        .modal-title { color: #fff; font-weight: 700; }
        .btn-close { filter: invert(1); }

        .modal-body { padding: 24px; }

        .form-label { font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.6); }

        .form-control {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: #e2e8f0;
            font-size: 14px;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.08);
            border-color: #a855f7;
            box-shadow: 0 0 0 3px rgba(168,85,247,0.2);
            color: #fff;
        }

        .form-control::placeholder { color: rgba(255,255,255,0.25); }

        .days-info {
            background: rgba(59,130,246,0.1);
            border: 1px solid rgba(59,130,246,0.25);
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            color: #93c5fd;
        }

        .modal-footer {
            background: rgba(255,255,255,0.02);
            border-top: 1px solid rgba(255,255,255,0.07);
            padding: 16px 24px;
            border-radius: 0 0 14px 14px;
        }

        .btn-secondary-custom {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.6);
            border-radius: 8px;
            padding: 8px 18px;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-secondary-custom:hover { background: rgba(255,255,255,0.1); color: #fff; }

        .btn-submit {
            background: linear-gradient(135deg, #a855f7, #3b82f6);
            border: none;
            color: #fff;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn-submit:hover { opacity: 0.85; }

        .alert-danger-custom {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            color: #f87171;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
<div class="layout">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <div class="brand-name">&#128197; HR Portal</div>
            <div class="brand-sub">Leave Management</div>
        </div>
        <div class="sidebar-nav">
            <div class="nav-section">Menu</div>
            <a href="#" class="nav-item">&#127968; Dashboard</a>
            <a href="#" class="nav-item active">&#128197; Leave</a>
            <a href="#" class="nav-item">&#128100; My Profile</a>
            <a href="#" class="nav-item">&#128202; Reports</a>
            <div class="nav-section" style="margin-top:8px">System</div>
            <a href="#" class="nav-item">&#9881;&#65039; Settings</a>
        </div>
        <div class="sidebar-footer">
            <div class="d-flex align-items-center gap-2">
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
                <span style="font-size:13px;color:rgba(255,255,255,0.35)">{{ now()->format('D, d M Y') }}</span>
                <button class="btn-apply" data-bs-toggle="modal" data-bs-target="#applyModal">+ Apply for Leave</button>
            </div>
        </div>

        <div class="content">

            @if(session('success'))
                <div class="alert-success-custom">
                    <span>&#10003; &nbsp;{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" style="background:none;border:none;color:#4ade80;font-size:18px;cursor:pointer;line-height:1">&times;</button>
                </div>
            @endif

            <!-- Hero -->
            <div class="hero mb-4">
                <h5>Welcome back, James &#128075;</h5>
                <p>You have <strong>{{ $leaves->where('status', 'Pending')->count() }} pending</strong> application(s) and <strong style="color:#3b82f6">14 annual leave days</strong> remaining this year.</p>
            </div>

            <!-- Notice -->
            <div class="notice mb-4">
                &#9888;&#65039; &nbsp; Leave applications must be submitted at least <strong>3 working days</strong> in advance.
            </div>

            <!-- Balance Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="balance-card card-annual">
                        <span class="card-icon">&#127958;</span>
                        <div class="card-label">Annual Leave</div>
                        <div class="card-value">14</div>
                        <div class="card-sub">of 21 days remaining</div>
                        <div class="progress-bar-wrap"><div class="progress-bar-fill fill-purple" style="width:66%"></div></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="balance-card card-sick">
                        <span class="card-icon">&#127973;</span>
                        <div class="card-label">Medical Leave</div>
                        <div class="card-value">10</div>
                        <div class="card-sub">of 14 days remaining</div>
                        <div class="progress-bar-wrap"><div class="progress-bar-fill fill-red" style="width:71%"></div></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="balance-card card-casual">
                        <span class="card-icon">&#9728;&#65039;</span>
                        <div class="card-label">Casual Leave</div>
                        <div class="card-value">3</div>
                        <div class="card-sub">of 7 days remaining</div>
                        <div class="progress-bar-wrap"><div class="progress-bar-fill fill-yellow" style="width:43%"></div></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="balance-card card-total">
                        <span class="card-icon">&#128202;</span>
                        <div class="card-label">Total Taken</div>
                        <div class="card-value">{{ $leaves->where('status', 'Approved')->sum('days') }}</div>
                        <div class="card-sub">approved days this year</div>
                        <div class="progress-bar-wrap"><div class="progress-bar-fill fill-green" style="width:{{ min(($leaves->where('status','Approved')->sum('days') / 21) * 100, 100) }}%"></div></div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-card">
                <div class="table-card-header">
                    <h6>&#128203; My Leave Applications</h6>
                    <div class="d-flex align-items-center gap-2">
                        <span style="font-size:12px;color:rgba(255,255,255,0.3)">{{ $leaves->count() }} total</span>
                        <select class="form-select form-select-sm" style="width:auto" id="statusFilter" onchange="filterTable()">
                            <option value="">All Status</option>
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table>
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
                                <td style="color:rgba(255,255,255,0.25)">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="emp-avatar">{{ strtoupper(substr($leave->employee_name, 0, 2)) }}</div>
                                        <span style="color:#fff">{{ $leave->employee_name }}</span>
                                    </div>
                                </td>
                                <td><span class="type-badge type-{{ $leave->leave_type }}">{{ ucfirst($leave->leave_type) }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}</td>
                                <td><strong style="color:#fff">{{ $leave->days }}</strong></td>
                                <td style="max-width:150px">
                                    <span style="display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="{{ $leave->reason }}">
                                        {{ $leave->reason }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-pill pill-{{ strtolower($leave->status) }}">
                                        <span class="dot"></span>{{ $leave->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($leave->status === 'Pending')
                                        <form action="{{ route('leaves.destroy', $leave) }}" method="POST" onsubmit="return confirm('Cancel this application?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-cancel">Cancel</button>
                                        </form>
                                    @else
                                        <span style="color:rgba(255,255,255,0.15)">—</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <div class="icon">&#128235;</div>
                                        <div style="color:rgba(255,255,255,0.4);font-weight:500;margin-bottom:4px">No applications yet</div>
                                        <div style="font-size:13px">Click <strong style="color:#a855f7">Apply for Leave</strong> to get started.</div>
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

<!-- Modal -->
<div class="modal fade" id="applyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">&#128221; Apply for Leave</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('leaves.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert-danger-custom">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li style="font-size:13px">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Employee Name <span style="color:#f87171">*</span></label>
                            <input type="text" name="employee_name" class="form-control" value="{{ old('employee_name') }}" placeholder="Your full name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Leave Type <span style="color:#f87171">*</span></label>
                            <select name="leave_type" class="form-select" required>
                                <option value="">-- Select type --</option>
                                <option value="annual"  {{ old('leave_type') == 'annual'  ? 'selected' : '' }}>Annual Leave (14 days left)</option>
                                <option value="sick"    {{ old('leave_type') == 'sick'    ? 'selected' : '' }}>Medical Leave (10 days left)</option>
                                <option value="casual"  {{ old('leave_type') == 'casual'  ? 'selected' : '' }}>Casual Leave (3 days left)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Date <span style="color:#f87171">*</span></label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required onchange="calcDays()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date <span style="color:#f87171">*</span></label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required onchange="calcDays()">
                        </div>
                        <div class="col-12" id="daysPreview" style="display:none">
                            <div class="days-info">
                                &#128197; &nbsp;Working days requested: <strong id="daysCount">0</strong> day(s) — weekends excluded
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Reason <span style="color:#f87171">*</span></label>
                            <textarea name="reason" class="form-control" rows="3" placeholder="Briefly describe the reason for your leave..." required>{{ old('reason') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-submit">Submit Application &#8594;</button>
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
            preview.style.display = 'none'; return;
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