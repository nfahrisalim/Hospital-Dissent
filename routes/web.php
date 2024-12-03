<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\MedicineManagementController;
use App\Http\Controllers\Admin\DoctorManagementController;
use App\Http\Controllers\Dokter\MedicalRecordController;
use App\Http\Controllers\Pasien\RecordController;
use App\Http\Controllers\Pasien\MedicineOrderController;
use App\Http\Controllers\Pasien\TestimonialController;
use App\Http\Controllers\Pasien\PasienDoctorController;
use App\Http\Controllers\Dokter\PatientController;
use App\Http\Controllers\Pasien\AppointmentController;
use App\Http\Controllers\Dokter\DoctorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index'); 
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create'); 
    Route::post('/users', [UserManagementController::class, 'store'])->name('users.store'); 
    Route::get('/users/{id}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{id}', [UserManagementController::class, 'update'])->name('users.update'); 
    Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy'); 
});

// Medicine management routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/medicines', [MedicineManagementController::class, 'index'])->name('medicines.index'); 
    Route::get('/medicines/create', [MedicineManagementController::class, 'create'])->name('medicines.create'); 
    Route::post('/medicines', [MedicineManagementController::class, 'store'])->name('medicines.store'); 
    Route::get('/medicines/{id}/edit', [MedicineManagementController::class, 'edit'])->name('medicines.edit'); 
    Route::patch('/medicines/{id}', [MedicineManagementController::class, 'update'])->name('medicines.update'); 
    Route::delete('/medicines/{id}', [MedicineManagementController::class, 'destroy'])->name('medicines.destroy'); 
});

// Dokter routes
Route::prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/medical-records', [MedicalRecordController::class, 'index'])->name('medical_records.index'); 
    Route::get('/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical_records.create'); 
    Route::post('/medical-records', [MedicalRecordController::class, 'store'])->name('medical_records.store'); 
    Route::get('/medical-records/{id}/edit', [MedicalRecordController::class, 'edit'])->name('medical_records.edit'); 
    Route::patch('/medical-records/{id}', [MedicalRecordController::class, 'update'])->name('medical_records.update'); 
    Route::delete('/medical-records/{id}', [MedicalRecordController::class, 'destroy'])->name('medical_records.destroy'); 
});

// Patients routes
Route::prefix('dokter')->name('dokter.')->group(function () {
    Route::get('patients', [PatientController::class, 'index'])->name('patients.list');  
    Route::get('patients/{id}', [PatientController::class, 'show'])->name('patients.show');
    Route::patch('patients/{id}/update-family-contact', [PatientController::class, 'updateFamilyContact'])->name('patients.updateFamilyContact');
    Route::patch('patients/{id}/update-details', [PatientController::class, 'updateDetails'])->name('patients.updateDetails');
});

// Appointments routes
Route::prefix('dokter')->name('dokter.')->middleware('auth')->group(function() {
    Route::resource('appointments', AppointmentController::class)->only(['index', 'store', 'destroy']);
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::prefix('dokter')->name('dokter.')->middleware('auth')->group(function () {
//     // View Doctor Profile
//     Route::get('/profile', [DoctorController::class, 'show'])->name('profile.show');
    
//     // Edit Doctor Profile
//     Route::get('/profile/edit', [DoctorController::class, 'edit'])->name('profile.edit');
//     Route::post('/profile/{id}/update', [DoctorController::class, 'update'])->name('profile.update');
    
//     // Doctor Settings (for personalizing the profile)
//     Route::get('/profile/settings', [DoctorController::class, 'settings'])->name('profile.settings');
//     Route::post('/profile/settings', [DoctorController::class, 'updateSettings'])->name('profile.updateSettings');
// });

Route::prefix('admin')->group(function () {
    Route::get('doctors', [DoctorManagementController::class, 'index'])->name('admin.doctors.index');
    Route::get('doctors/{id}', [DoctorManagementController::class, 'show'])->name('admin.doctors.show');
    Route::get('doctors/{id}/edit', [DoctorManagementController::class, 'edit'])->name('admin.doctors.edit');
    Route::patch('doctors/{id}', [DoctorManagementController::class, 'update'])->name('admin.doctors.update');
    Route::delete('doctors/{id}', [DoctorManagementController::class, 'destroy'])->name('admin.doctors.destroy');
});

Route::prefix('pasien')->group(function () {
    Route::get('{id}/record', [RecordController::class, 'index'])->name('pasien.record.index');
});


Route::prefix('pasien')->group(function () {
    Route::get('medicine_order/create/{medicalRecordId}', [MedicineOrderController::class, 'create'])->name('pasien.medicine_order.create');
    Route::post('medicine_order/store/{medicalRecordId}', [MedicineOrderController::class, 'store'])->name('pasien.medicine_order.store');
    Route::get('medicine_order/{medicalRecordId}', [MedicineOrderController::class, 'index'])->name('pasien.medicine_order.index');
});

Route::prefix('pasien')->group(function () {
    Route::get('pasien/dokter/{id}', [PasienDoctorController::class, 'show'])->name('pasien.doctor.profile');

    Route::get('dokter/{doctorId}/testimonials/create', [TestimonialController::class, 'create'])->name('pasien.testimonials.create');
    Route::post('pasien/dokter/{doctorId}/testimonials', [TestimonialController::class, 'store'])->name('pasien.testimonials.store');
    Route::get('appointments', [AppointmentController::class, 'index'])->name('pasien.appointments.index');
    Route::get('appointments/create/{doctorId}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});


require __DIR__.'/auth.php';
