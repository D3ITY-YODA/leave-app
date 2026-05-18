<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AdminController;

Route::get('/', [LeaveController::class, 'index'])->name('leaves.index');
Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
Route::delete('/leaves/{leaveApplication}', [LeaveController::class, 'destroy'])->name('leaves.destroy');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/approve/{leaveApplication}', [AdminController::class, 'approve'])->name('admin.approve');
Route::post('/admin/reject/{leaveApplication}',  [AdminController::class, 'reject'])->name('admin.reject');
