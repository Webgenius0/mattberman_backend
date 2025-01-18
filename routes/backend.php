<?php


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\DashboardController;



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('admin.dashboard');
Route::get('/allDrivers', [DashboardController::class,'showAllDrivers'])->middleware(['auth'])->name('show.all.drivers');
Route::get('/allInspectionsOfaDriver/{email}', [DashboardController::class,'showAllInspections'])->middleware(['auth'])->name('inspection.details');
Route::get('/pdfInspection/{id}', [DashboardController::class,'pdf_inspection'])->middleware(['auth'])->name('pdfInspection.web');

