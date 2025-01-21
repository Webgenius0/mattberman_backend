<?php


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\DashboardController;



// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('admin.dashboard');
// Route::get('/allDrivers', [DashboardController::class,'showAllDrivers'])->middleware(['auth'])->name('show.all.drivers');
// Route::get('/allInspectionsOfaDriver/{email}', [DashboardController::class,'showAllInspections'])->middleware(['auth'])->name('inspection.details');
// Route::get('/pdfInspection/{id}', [DashboardController::class,'pdf_inspection'])->middleware(['auth'])->name('pdfInspection.web');


Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard',  'index')->name('admin.dashboard');
        Route::get('/allDrivers', 'showAllDrivers')->name('show.all.drivers');
        Route::get('/allInspectionsOfaDriver/{email}', 'showAllInspections')->name('inspection.details');
        Route::get('/pdfInspection/{id}', 'pdf_inspection')->name('pdfInspection.web');
        Route::get('/privacy-policy','privacy')->name('admin.privacypolicy');
        Route::post('/privacy-policy-store','privacystore')->name('admin.privacystore');
        Route::get('/term-condition','term_condition')->name('admin.term&condition');
        Route::post('/term-condition-store','term_conditionstore')->name('admin.term&conditionstore');
    });
});