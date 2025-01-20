<?php

use function Pest\Laravel\get;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\InspectionController;


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/forget-password', 'forgetPassword');
    Route::post('/verify-otp-reset-password',  'verifyOtpResetPassword');
    Route::post('/reset-password', 'resetPassword');
});


Route::middleware('auth:api')->group(function () {

    Route::controller(InspectionController::class)->group(function () {
        Route::post('/inspection-store', 'store');
        Route::post('/inspection-update/{id}', 'update');
        Route::get('/inspection', 'showAllInspections');
        Route::get('/inspection-pdf/{id}', 'pdf_inspection');
        Route::delete('/inspection-delete/{id}', 'destroy');
    });

    Route::post('/logout', [AuthController::class,'logout']);

});

