<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Leave Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <style>
        * { box-sizing: border-box; }
        body { background: #0a0a0f; font-family: 'Segoe UI', sans-serif; color: #e2e8f0; }
        body::before {
            content: '';
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background:
                radial-gradient(ellipse at 10% 20%, rgba(120,40,255,0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 90% 80%, rgba(0,200,255,0.12) 0%, transparent 50%);
            pointer-events: none; z-index: 0;
        }
        .layout { display: flex; min-height: 100vh; position: relative; z-index: 1; }
        .sidebar { width: 240px; background: rgba(15,15,25,0.95); border-right: 1px solid rgba(255,255,255,0.06); flex-shrink: 0; display: flex; flex-direction: column; }
        .brand { padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .brand-name { font-size: 18px; font-weight: 700; background: linear-gradient(90deg, #a855f7, #3b82f6, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .brand-sub { font-size: 11px; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1.2px; margin-top: 2px; }
        .sidebar-nav { padding: 16px 10px; flex: 1; }
        .nav-section { font-size: 10px; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.2); padding: 10px 12px 4px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 8px; color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px; margin-bottom: 2px; transition: all 0.2s; }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: #fff; }
        .nav-item.active { background: linear-gradient(135deg, rgba(168,85,247,0.3), rgba(59,130,246,0.3)); color: #fff; border: 1px solid rgba(168,85,247,0.3); }
        .sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(255,255,255,0.06); }
        .user-avatar { width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, #ef4444, #f97316); color: #fff; font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; }
        .user-name { font-size: 13px; font-weight: 600; color: #fff; }
        .user-role { font-size: 11px; color: rgba(255,255,255,0.35); }
        .topbar { background: rgba(15,15,25,0.9); border-bottom: 1px solid rgba(255,255,255,0.06); padding: 0 28px; height: 58px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .breadcrumb-text { font-size: 14px; color: rgba(255,255,255,0.4); }
        .breadcrumb-text strong { color: #fff; }
        .content { padding: 28px; }
        .stat-card { border-radius: 12px; padding: 20px; border: 1px solid rgba(255,255,255,0.07); }
        .stat-card .value { font-size: 32px; font-weight: 700; line-height: 1; }
        .stat-card .label { font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px; }
        .card-pending  { background: linear-gradient(135deg, rgba(234,179,8,0.15),  rgba(234,179,8,0.05)); }
        .card-approved { background: linear-gradient(135deg, rgba(34,197,94,0.15),   rgba(34,197,94,0.05)); }
        .card-rejected { background: linear-gradient(135deg, rgba(239,68,68,0.15),   rgba(239,68,68,0.05)); }
        .table-card { background: rgba(15,15,25,0.8); border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; overflow: hidden; }
        .table-card-header { padding: 16px 20px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: space-between; }
        table { width: 100%; border-collapse: collapse; }
        thead th { padding: 12px 16px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.3); background: rgba(255,255,255,0.02); border-bottom: 1px solid rgba(255,255,255,0.06); }
        tbody td { padding: 14px 16px; font-size: 14px; color: rgba(255,255,255,0.75); border-bottom: 1px solid rgba(255,255,255,0.04); vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: rgba(255,255,255,0.03); }
        .type-badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .type-annual { background: rgba(168,85,247,0.2); color: #c084fc; border: 1px solid rgba(168,85,247,0.3); }
        .type-sick   { background: rgba(239,68,68,0.2);  color: #f87171; border: 1px solid rgba(239,68,68,0.3); }
        .type-casual { background: rgba(234,179,8,0.2);  color: #fbbf24; border: 1px solid rgba(234,179,8,0.3); }
        .status-pill { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .dot { width: 6px; height: 6px; border-radius: 50%; }
        .pill-pending  { background: rgba(234,179,8,0.15);  color: #fbbf24; border: 1px solid rgba(234,179,8,0.25); }
        .pill-pending .dot  { background: #fbbf24; }
        .pill-approved { background: rgba(34,197,94,0.15);  color: #4ade80; border: 1px solid rgba(34,197,94,0.25); }
        .pill-approved .dot { background: #4ade80; }
        .pill-rejected { background: rgba(239,68,68,0.15);  color: #f87171; border: 1px solid rgba(239,68,68,0.25); }
        .pill-rejected .dot { background: #f87171; }
        .emp-avatar { width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, #a855f7, #3b82f6); color: #fff; font-size: 11px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .btn-approve { padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; border: 1px solid rgba(34,197,94,0.4); background: rgba(34,197,94,0.1); color: #4ade80; cursor: pointer; transition: all 0.15s; }
        .btn-approve:hover { background: rgba(34,197,94,0.25); }
        .btn-reject  { padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; border: 1px solid rgba(239,68,68,0.4); background: rgba(239,68,68,0.1); color: #f87171; cursor: pointer; transition: all 0.15s; }
        .btn-reject:hover { background: rgba(239,68,68,0.25); }
        .toast-custom { position: fixed; top: 24px; right: 24px; z-index: 9999; background: linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.05)); border: 1px solid rgba(34,197,94,0.35); color: #4ade80; border-radius: 12px; padding: 16px 20px; font-size: 14px; display: flex; align-items: center; gap: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.4); min-width: 280px; animation: slideIn 0.3s ease; }
        @keyframes slideIn { from { opacity:0; transform:translateX(40px); } to { opacity:1; transform:translateX(0); } }
    </style>
</head>
<body>
<div class="layout">
    <div class="sidebar">
        <div class="brand">
            <div class="brand-name">&#128197; HR Portal</div>
            <div class="brand-sub">Admin Panel</div>
        </div>
        <div class="sidebar-nav">
            <div class="nav-section">Menu</div>
            <a href="{{ route('leaves.index') }}" class="nav-item">&#128197; Employee View</a>
            <a href="{{ route('admin.index') }}"  class="nav-item active">&#9878;&#65039; Admin Panel</a>
            <div class="nav-section" style="margin-top:8px">System</div>
            <a href="#" class="nav-item">&#9881;&#65039; Settings</a>
        </div>
        <div class="sidebar-footer">
            <div class="d-flex align-items-center gap-2">
                <div class="user-avatar">AD</div>
                <div>
                    <div class="user-name">Admin</div>
                    <div class="user-role">HR Manager</div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow-1" style="min-width:0">
        <div class="topbar">
            <div class="breadcrumb-text">Home &rsaquo; <strong>Admin Panel</strong></div>
            <a href="{{ route('leaves.index') }}" style="font-size:13px;color:rgba(255,255,255,0.4);text-decoration:none">&#8592; Employee View</a>
        </div>

        <div class="content">

            @if(session('success'))
            <div class="toast-custom" id="toast">
                <span style="font-size:20px">&#10003;</span>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" style="background:none;border:none;color:#4ade80;font-size:20px;cursor:pointer;margin-left:auto;line-height:1">&times;</button>
            </div>
            <script>setTimeout(function(){ var t=document.getElementById('toast'); if(t)t.remove(); }, 4000);</script>
            @endif

            <div class="mb-4">
                <h4 style="color:#fff;margin:0">&#9878;&#65039; Admin Panel</h4>
                <p style="color:rgba(255,255,255,0.4);font-size:14px;margin-top:4px">Review and manage all leave applications</p>
            </div>

            <!-- Stats -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card card-pending">
                        <div style="font-size:24px;margin-bottom:8px">&#9203;</div>
                        <div class="value" style="color:#fbbf24">{{ $pending }}</div>
                        <div class="label" style="color:rgba(251,191,36,0.6)">Pending Review</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card card-approved">
                        <div style="font-size:24px;margin-bottom:8px">&#10003;</div>
                        <div class="value" style="color:#4ade80">{{ $approved }}</div>
                        <div class="label" style="color:rgba(74,222,128,0.6)">Approved</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card card-rejected">
                        <div style="font-size:24px;margin-bottom:8px">&#10005;</div>
                        <div class="value" style="color:#f87171">{{ $rejected }}</div>
                        <div class="label" style="color:rgba(248,113,113,0.6)">Rejected</div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-card">
                <div class="table-card-header">
                    <h6 style="color:#fff;margin:0;font-weight:600">&#128203; All Leave Applications</h6>
                    <span style="font-size:12px;color:rgba(255,255,255,0.3)">{{ $leaves->count() }} total</span>
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($leaves as $leave)
                            <tr>
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
                                <td style="max-width:160px">
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
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('admin.approve', $leave) }}" method="POST">
                                            @csrf
                                            <button class="btn-approve">&#10003; Approve</button>
                                        </form>
                                        <form action="{{ route('admin.reject', $leave) }}" method="POST" onsubmit="return confirm('Reject this application?')">
                                            @csrf
                                            <button class="btn-reject">&#10005; Reject</button>
                                        </form>
                                    </div>
                                    @else
                                        <span style="color:rgba(255,255,255,0.2);font-size:13px">—</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" style="text-align:center;padding:60px;color:rgba(255,255,255,0.25)">
                                    <div style="font-size:40px;margin-bottom:12px">&#128203;</div>
                                    No applications to review yet.
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
