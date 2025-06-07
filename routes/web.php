<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiclePlatesController;
use App\Http\Controllers\EnquiryController;

// user home
Route::get('/', function () {
    return view('welcome', ['vehicles' => []]);
})->name('home');

Auth::routes();

// admin home
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// search for vehicle plate basic
Route::get('/search', [VehiclePlatesController::class,'search'])->name('vehicles.search');

// vehicle plates routes
Route::middleware(['auth'])->group(function () {
    Route::get('/vehicle-plates', [VehiclePlatesController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicle-plates/{id}', [VehiclePlatesController::class, 'show'])->name('vehicles.show');
    Route::get('/vehicle-plates/{id}/edit', [VehiclePlatesController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicle-plates/update', [VehiclePlatesController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicle-plates/delete/{id}', [VehiclePlatesController::class, 'destroy'])->name('vehicles.destroy');
    Route::post('/vehicle-plates/store', [VehiclePlatesController::class, 'store'])->name('vehicles.store');

    Route::get('/upload', [VehiclePlatesController::class, 'upload'])->name('vehicles.upload');
    //  bulk upload vehicle plates
    Route::post('/vehicle-plates/bulk-upload', [VehiclePlatesController::class,'bulk_upload'])->name('vehicles.bulk_upload')->middleware('auth');
});

// enquiry plates
Route::get('/enquiry', [EnquiryController::class, 'index'])->name('enquiry.index');
Route::post('post-enquiry', [EnquiryController::class, 'send'])->name('enquiry.post');



