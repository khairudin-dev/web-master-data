<?php

use App\Http\Controllers\RegisLahanController;
use App\Http\Controllers\RegisLapangController;
use App\Http\Controllers\uniqueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('app', ['title'=>'Dashboard']);
});
Route::get('/regis-lahan',[RegisLahanController::class, 'rsgis_page'])->name('regis lahan');
Route::get('/edit-lahan/{s}',[RegisLahanController::class, 'edit_page'])->name('edit lahan');
Route::get('/lahan',[RegisLahanController::class, 'lahan'])->name('lahan');
Route::get('/detail-lahan/{no_blok}', [RegisLahanController::class, 'getDetail'])->name('detail lahan');
Route::post('/regis-lahan',[RegisLahanController::class, 'regis'])->name('post regis lahan');
Route::put('/update-lahan/{s}',[RegisLahanController::class, 'update'])->name('update regis lahan');
Route::delete('/del-lahan/{s}',[RegisLahanController::class, 'delete'])->name('delete regis lahan');
Route::post('/u-blk', [uniqueController::class, 'validateBlok'])->name('u-blk');

Route::get('/regis-lapang',[RegisLapangController::class, 'lapang'])->name('regis lapang');