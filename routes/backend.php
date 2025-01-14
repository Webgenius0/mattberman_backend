<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\DashboardController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
