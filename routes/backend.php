<?php


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\ProfileController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\AdvertisementController;

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


    // Route::controller(AdvertisementController::class)->group(function () {

    //     Route::get('/adds-create','adds_create')->name('admin.adds.create');
    //     Route::post('/adds-store','adds_store')->name('admin.adds.store');
    //     Route::get('/adds-show','showAlladvertisement')->name('show.all.advertisement');
    //     Route::delete('/adds-delete/{id}','deleteAdvertisement')->name('advertisement.destroy');
    // });

    
    Route::controller(AdvertisementController::class)->group(function () {
        Route::get('/adds-create', 'adds_create')->name('admin.adds.create');
        Route::post('/adds-store', 'adds_store')->name('admin.adds.store');
        Route::get('/adds-show', 'showAlladvertisement')->name('show.all.advertisement');
        Route::post('/adds-delete/{id}', 'deleteAdvertisement')->name('advertisement.destroy');
        // Route::get('/adds-delete/{id}', 'deleteAdvertisement')->name('advertisement.destroy');

    });
    
    
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile','admin_profile')->name('admin.profile');
        Route::post('profile-update','admin_profile_update')->name('admin.update.profile');
        Route::get('profile-password','password')->name('admin.password');
        Route::post('profile-update-password','changePassword')->name('admin.update.password');
    });

});


