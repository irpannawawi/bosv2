<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\DusunController;
use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\UraianController;
use App\Http\Controllers\WargaController;
use App\Models\Anggota;
use Illuminate\Support\Facades\Route;


Route::get('/', function (Anggota $anggotas) {
    return view('welcome', ['anggotas'=>$anggotas::all()]);
});

Route::resource('anggota', AnggotaController::class);
Route::resource('provinsi', ProvinsiController::class);
Route::resource('kabupaten', KabupatenController::class);
Route::resource('kecamatan', KecamatanController::class);
Route::resource('desa', DesaController::class);
Route::resource('dusun', DusunController::class);
Route::get('/warga/load', [WargaController::class, 'load'])->name('warga.load');
Route::resource('warga', WargaController::class);
Route::resource('uraian', UraianController::class);

Route::get('/generator', [GeneratorController::class, 'index'])->name('generator.index');
Route::get('/generator/generate', [GeneratorController::class, 'generate'])->name('generator.create');
Route::get('/generator/download/{nrp}', [GeneratorController::class, 'download'])->name('generator.download');