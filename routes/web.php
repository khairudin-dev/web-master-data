<?php

use App\Http\Controllers\AnalissController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PemantauanController;
use App\Http\Controllers\ProsesController;
use App\Http\Controllers\RegisLahanController;
use App\Http\Controllers\RegisLapangController;
use App\Http\Controllers\SampelController;
use App\Http\Controllers\uniqueController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth', 'role:produksi,superadmin'])->group(function () {
    Route::get('/regis-lahan', [RegisLahanController::class, 'rsgis_page'])->name('regis lahan');
    Route::get('/edit-lahan/{s}', [RegisLahanController::class, 'edit_page'])->name('edit lahan');
    Route::get('/lahan', [RegisLahanController::class, 'lahan'])->name('lahan');
    Route::post('/regis-lahan', [RegisLahanController::class, 'regis'])->name('post regis lahan');
    Route::put('/update-lahan/{s}', [RegisLahanController::class, 'update'])->name('update regis lahan');
    Route::delete('/del-lahan/{s}', [RegisLahanController::class, 'delete'])->name('delete regis lahan');
    Route::post('/u-blk', [uniqueController::class, 'validateBlok'])->name('u-blk');

    Route::get('/panen-input', [PanenController::class, 'lapang'])->name('input panen');
    Route::get('/panen-input/{s}', [PanenController::class, 'form'])->name('form panen');
    Route::put('/panen-input/{s}', [PanenController::class, 'post'])->name('post panen');
    Route::get('/panen', [PanenController::class, 'panen'])->name('panen');
});
Route::middleware(['auth', 'role:qc,superadmin'])->group(function () {
    Route::get('/regis-lapang', [RegisLapangController::class, 'lahan'])->name('regis lapang');
    Route::get('/lapang', [RegisLapangController::class, 'lapang'])->name('lapang');
    Route::put('/regis-lapang/{s}', [RegisLapangController::class, 'regis'])->name('post regis lapang');
    Route::post('/u-lpg', [uniqueController::class, 'validateLapang'])->name('u-lpg');
    Route::get('/pemantauan-lapang', [PemantauanController::class, 'pemantauan'])->name('pemantauan lapang');
    Route::get('/pemantauan-lapang-input', [PemantauanController::class, 'lapang'])->name('input pemantauan lapang');
    Route::get('/pemantauan-lapang-input/{s}', [PemantauanController::class, 'form'])->name('form pemantauan lapang');
    Route::put('/pemantauan/pendahuluan/{s}', [PemantauanController::class, 'pendahuluan'])->name('post pendahuluan');
    Route::put('/pemantauan/pl1/{s}', [PemantauanController::class, 'pl1'])->name('post pl1');
    Route::put('/pemantauan/pl2/{s}', [PemantauanController::class, 'pl2'])->name('post pl2');
    Route::put('/pemantauan/pl3/{s}', [PemantauanController::class, 'pl3'])->name('post pl3');
});
Route::middleware(['auth', 'role:analis,superadmin'])->group(function () {
    Route::get('/uji-lab/input', [AnalissController::class, 'lapang'])->name('input uji lab');
    Route::get('/uji-lab/input/{s}', [AnalissController::class, 'form'])->name('form uji lab');
    Route::put('/uji-lab/input/{s}', [AnalissController::class, 'post'])->name('post uji lab');
    Route::get('/uji-lab', [AnalissController::class, 'lab'])->name('lab');
});
Route::middleware(['auth', 'role:marketing,superadmin'])->group(function () {
    Route::get('/marketing/input', [MarketingController::class, 'lapang'])->name('input marketing');
    Route::get('/marketing/input/{s}', [MarketingController::class, 'form'])->name('form marketing');
    Route::put('/marketing/input/{s}', [MarketingController::class, 'post'])->name('post marketing');
    Route::get('/marketing', [MarketingController::class, 'mkt'])->name('mkt');
});
Route::middleware(['auth', 'role:procesing,superadmin'])->group(function () {
    Route::get('/proses/input', [ProsesController::class, 'input'])->name('input proses');
    Route::get('/proses', [ProsesController::class, 'proses_data'])->name('proses');
    Route::put('/proses/{s}', [ProsesController::class, 'proses'])->name('post input proses');
    Route::get('/sampel/input', [SampelController::class, 'input'])->name('input sampel');
    Route::get('/sampel', [SampelController::class, 'sampel_data'])->name('sampel');
    Route::put('/sampel/{s}', [SampelController::class, 'sampel'])->name('post input sampel');
});
Route::middleware(['auth', 'role:manager qc'])->group(function () {});
Route::middleware(['auth', 'role:superadmin'])->group(function () {});
Route::middleware(['auth'])->group(function () {
    Route::get('/detail-lahan/{no_blok}', [LahanController::class, 'getDetail'])->name('detail lahan');
    Route::get('/buku-besar', [LahanController::class, 'bukuBesar'])->name('buku besar');

    Route::get('/home', function () {
        return redirect('/');
    })->name('home');
});
Route::get('/', function () {
    // return view('welcome');
    if (Auth::check()) {
        // return view('app', ['title' => 'Dashboard']);
        return app(DashboardController::class)->index();
    } else {
        return view('landingpage');
    }
});
Route::get('/g', function () {
    return view('grafik', ['title' => 'Dashboard']);
})->name('home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
