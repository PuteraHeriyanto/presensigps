<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
    
});
Route::middleware(['guest:user'])->group(function(){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin', [AuthController::class,'prosesloginadmin']);
});

Route::middleware(['auth:karyawan'])->group(function(){
    Route::get('/dashboard', [DashboardController::class,'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    //Presensi
    Route::get('/presensi/create',[PresensiController::class,'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    //Edit Profile
    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class,'updateprofile']);

    //Histori
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    //Izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);


});

Route::middleware(['auth:user'])->group(function(){
     Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
     Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

     //karyawan
     Route::get('/karyawan',[KaryawanController::class,'index']);
     Route::post('/karyawan/store',[KaryawanController::class,'store']);
     Route::post('/karyawan/edit',[KaryawanController::class,'edit']);
     Route::post('/karyawan/{nik}/update',[KaryawanController::class,'update']);
     Route::post('/karyawan/{nik}/delete',[KaryawanController::class,'delete']);

     //Departement
     Route::get('/departemen',[DepartemenController::class,'index']);
     Route::post('/departemen/store',[DepartemenController::class,'store']);
     Route::post('/departemen/edit',[DepartemenController::class,'edit']);
     Route::post('/departemen/{kode_dept}/update',[DepartemenController::class,'update']);
     Route::post('/departemen/{kode_dept}/delete',[DepartemenController::class,'delete']);

     //PresensiMonitoring
     Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
     Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
     Route::post('/tampilkanpeta', [PresensiController::class, 'tampilkanpeta']);
     Route::get('/presensi/laporan', [PresensiController::class, 'laporan']);
     Route::post('/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);
     Route::get('/presensi/rekap', [PresensiController::class, 'rekap']);
     Route::post('/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);
     Route::get('/presensi/izinsakit', [PresensiController::class, 'izinsakit']);
     Route::post('/presensi/approveizinsakit', [PresensiController::class, 'approveizinsakit']);
     Route::get('/presensi/{id}/batalkanizinsakit', [PresensiController::class, 'batalkanizinsakit']);
     
     //KonfigurasiLokasiKantor
     Route::get('/konfigurasi/lokasikantor', [KonfigurasiController::class, 'lokasikantor']);
     Route::post('/konfigurasi/updatelokasikantor', [KonfigurasiController::class, 'updatelokasikantor']);

});