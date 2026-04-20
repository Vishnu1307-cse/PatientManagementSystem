<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $totalPatients = \App\Models\Patient::count();
        $totalDoctors = \App\Models\Doctor::count();
        $totalVisits = \App\Models\Visit::count();
        return view('dashboard', compact('totalPatients', 'totalDoctors', 'totalVisits'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Patient UI Routes
    Route::get('/patients/trash', [PatientController::class, 'trash'])->name('patients.trash')->middleware('role:admin,receptionist,doctor'); // Assuming doctors might need to see it, but we can restrict. Let's keep it open to all for now or admin/receptionist.
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index')->middleware('role:admin,receptionist,doctor');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create')->middleware('role:admin,receptionist');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store')->middleware('role:admin,receptionist');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit')->middleware('role:admin,receptionist');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update')->middleware('role:admin,receptionist');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy')->middleware('role:admin,receptionist');

    Route::get('/patients/{patient}/visits', [VisitController::class, 'index'])->name('patients.visits')->middleware('role:admin,receptionist,doctor');

    // Admin only routes for soft deletes
    Route::middleware(['role:admin'])->group(function () {
        Route::post('/patients/{id}/restore', [PatientController::class, 'restore'])->name('patients.restore');
        Route::delete('/patients/{id}/force', [PatientController::class, 'forceDelete'])->name('patients.forceDelete');
    });

    // Visits & Reports operations (Admin, Doctor)
    Route::post('/visits', [VisitController::class, 'store'])->name('visits.store')->middleware('role:admin,doctor');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store')->middleware('role:admin,doctor');
});

require __DIR__.'/auth.php';
