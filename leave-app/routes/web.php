<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;

Route::get('/', [LeaveController::class, 'index'])->name('leaves.index');
Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
Route::delete('/leaves/{leaveApplication}', [LeaveController::class, 'destroy'])->name('leaves.destroy');