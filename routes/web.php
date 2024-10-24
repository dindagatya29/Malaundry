<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SatuanUnitController;
use App\Http\Controllers\PaketKuotaController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return redirect()->route('login');  // Redirect ke halaman login
});


Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware('auth');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Route::resource('satuan_units', SatuanUnitController::class);
// Route::resource('satuan_units', SatuanUnitController::class);
// Route::post('satuan_units/{satuanUnit}/toggle-active', [SatuanUnitController::class, 'toggleActive'])->name('satuan_units.toggle-active');
// Route::get('/satuan_units/search', [SatuanUnitController::class, 'search'])->name('satuan_units.search');

// Route untuk index halaman Satuan Units
Route::get('/satuan_units', [SatuanUnitController::class, 'index'])->name('satuan_units.index');

// Route untuk menyimpan satuan unit baru
Route::post('/satuan_units', [SatuanUnitController::class, 'store'])->name('satuan_units.store');

// Route untuk memperbarui satuan unit
Route::put('/satuan_units/{satuan_unit}', [SatuanUnitController::class, 'update'])->name('satuan_units.update');

// Route untuk menghapus satuan unit
Route::delete('/satuan_units/{satuan_unit}', [SatuanUnitController::class, 'destroy'])->name('satuan_units.destroy');

// Route untuk mengubah status aktif/tidak aktif satuan unit
Route::post('/satuan_units/{satuan_unit}/toggle-active', [SatuanUnitController::class, 'toggleActive'])->name('satuan_units.toggle-active');
// Route to show the details of a specific Satuan Unit
Route::get('/satuan_units/{id}', [SatuanUnitController::class, 'show'])->name('satuan_units.show');





Route::put('/paket_kuotas/{paketKuota}', [PaketKuotaController::class, 'update'])->name('paket_kuotas.update');
Route::resource('paket_kuotas', PaketKuotaController::class);
Route::post('paket_kuotas/{paketKuota}/toggle-active', [PaketKuotaController::class, 'toggleActive'])
     ->name('paket_kuotas.toggle-active');

