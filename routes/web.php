<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\TreatmentController;
Route::redirect('/','/admin');

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('patients', PatientsController::class)->names('patients');
    Route::resource('appointments', AppointmentController::class)->names('appointments');
    Route::resource('treatments', TreatmentController::class)->names('treatments');

    // Resource routes already define all CRUD routes for patients, appointments and treatments
});
