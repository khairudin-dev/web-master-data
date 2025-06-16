<?php

use App\Http\Controllers\LahanController;
use App\Http\Controllers\RegisLahanController;
use App\Http\Controllers\RegisLapangController;
use App\Http\Controllers\uniqueController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth', 'role:produksi'])->group(function () {
    Route::get('/regis-lahan', [RegisLahanController::class, 'rsgis_page'])->name('regis lahan');
    Route::get('/edit-lahan/{s}', [RegisLahanController::class, 'edit_page'])->name('edit lahan');
    Route::get('/lahan', [RegisLahanController::class, 'lahan'])->name('lahan');
    Route::post('/regis-lahan', [RegisLahanController::class, 'regis'])->name('post regis lahan');
    Route::put('/update-lahan/{s}', [RegisLahanController::class, 'update'])->name('update regis lahan');
    Route::delete('/del-lahan/{s}', [RegisLahanController::class, 'delete'])->name('delete regis lahan');
    Route::post('/u-blk', [uniqueController::class, 'validateBlok'])->name('u-blk');
});
Route::middleware(['auth', 'role:qc'])->group(function () {
    Route::get('/regis-lapang', [RegisLapangController::class, 'lapang'])->name('regis lapang');
});
Route::middleware(['auth', 'role:analis'])->group(function () {
});
Route::middleware(['auth', 'role:masketing'])->group(function () {
});
Route::middleware(['auth', 'role:manager qc'])->group(function () {
});
Route::middleware(['auth', 'role:superadmin'])->group(function () {
});
Route::middleware(['auth'])->group(function () {
    Route::get('/detail-lahan/{no_blok}', [LahanController::class, 'getDetail'])->name('detail lahan');
    Route::get('/', function () {
        // return view('welcome');
        return view('app', ['title' => 'Dashboard']);
    });
    Route::get('/home', function () {
        return redirect('/');
    })->name('home');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
