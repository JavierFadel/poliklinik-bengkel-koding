<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\PeriksaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::prefix('/poli')->as('poli.')->group(function () {
        Route::get('/', [PoliController::class, 'index'])->name('index');
        Route::get('/create', [PoliController::class, 'create'])->name('create');
        Route::post('/store', [PoliController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PoliController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PoliController::class, 'update'])->name('update');
    });
});

// Route::middleware(['login'])->group(function () {
//     Route::middleware(['roleAccess:1'])->group(function() {
//         Route::get('/asd', function() {
//             return view('welcome');
//         });
//     });

//     Route::prefix('/poli')->as('poli.')->group(function () {
//         Route::get('/', [PoliController::class, 'index'])->name('index');
//         Route::get('/create', [PoliController::class, 'create'])->name('create');
//         Route::post('/store', [PoliController::class, 'store'])->name('store');
//         Route::get('/{id}/edit', [PoliController::class, 'edit'])->name('edit');
//         Route::put('/{id}', [PoliController::class, 'update'])->name('update');
//     });
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // FIXME: route authentication problem
    Route::middleware(['roleAccess:1'])->group(function() {
        Route::get('/asd', function() {
            return view('welcome');
        });
    });

    Route::prefix('/dokter')->as('dokter.')->group(function () {
        Route::get('/', [DokterController::class, 'index'])->name('index');
        Route::get('/create', [DokterController::class, 'create'])->name('create');
        Route::post('/store', [DokterController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DokterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DokterController::class, 'update'])->name('update');
        Route::delete('/{id}', [DokterController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/pasien')->as('pasien.')->group(function () {
        Route::get('/', [PasienController::class, 'index'])->name('index');
        Route::get('/pasien-by-doctor', [PasienController::class, 'indexByDoctor'])->name('index-by-doctor');
        Route::get('/create', [PasienController::class, 'create'])->name('create');
        Route::post('/store', [PasienController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PasienController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PasienController::class, 'update'])->name('update');
        Route::delete('/{id}', [PasienController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/poli')->as('poli.')->group(function () {
        Route::get('/', [PoliController::class, 'index'])->name('index');
        Route::get('/create', [PoliController::class, 'create'])->name('create');
        Route::post('/store', [PoliController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PoliController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PoliController::class, 'update'])->name('update');
        Route::delete('/{id}', [PoliController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/obat')->as('obat.')->group(function () {
        Route::get('/', [ObatController::class, 'index'])->name('index');
        Route::get('/create', [ObatController::class, 'create'])->name('create');
        Route::post('/store', [ObatController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ObatController::class, 'update'])->name('update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/daftar-poli')->as('daftar-poli.')->group(function () {
        Route::get('/', [DaftarPoliController::class, 'index'])->name('index');
        Route::get('/create', [DaftarPoliController::class, 'create'])->name('create');
        Route::post('/store', [DaftarPoliController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DaftarPoliController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DaftarPoliController::class, 'update'])->name('update');
        Route::delete('/{id}', [DaftarPoliController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/jadwal')->as('jadwal.')->group(function () {
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('index');
        Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('create');
        Route::post('/store', [JadwalPeriksaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [JadwalPeriksaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [JadwalPeriksaController::class, 'update'])->name('update');
        Route::delete('/{id}', [JadwalPeriksaController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/periksa')->as('periksa.')->group(function () {
        Route::get('/', [PeriksaController::class, 'index'])->name('index');
        Route::get('/create', [PeriksaController::class, 'create'])->name('create');
        Route::post('/store', [PeriksaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PeriksaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PeriksaController::class, 'update'])->name('update');
        Route::delete('/{id}', [PeriksaController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/riwayat')->as('riwayat.')->group(function () {
        Route::get('/', [PeriksaController::class, 'riwayatPeriksa'])->name('index');
    });
});
