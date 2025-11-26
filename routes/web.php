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
    Route::post('patients/{patient}/delete', [PatientsController::class, 'delete'])->name('patients.delete');
    Route::post('patients/{id}/restore', [PatientsController::class, 'restore'])->name('patients.restore');


    Route::resource('appointments', AppointmentController::class)->names('appointments');
    Route::post('appointments/{appointment}/delete', [AppointmentController::class, 'delete'])->name('appointments.delete');
    Route::post('appointments/{id}/restore', [AppointmentController::class, 'restore'])->name('appointments.restore');

    
    Route::resource('treatments', TreatmentController::class)->names('treatments');
    Route::post('treatments/{treatment}/delete', [TreatmentController::class, 'delete'])->name('treatments.delete');
    Route::post('treatments/{id}/restore', [TreatmentController::class, 'restore'])->name('treatments.restore');

    // Resource routes already define all CRUD routes for patients, appointments and treatments
});
