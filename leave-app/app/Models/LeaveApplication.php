<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    protected $fillable = [
        'employee_name',
        'leave_type',
        'start_date',
        'end_date',
        'days',
        'reason',
        'status',
    ];
}