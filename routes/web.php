<?php

use App\Http\Controllers\admin\homeController;
use App\Http\Controllers\LK\LKController;
use App\Http\Controllers\LKController as ControllersLKController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\perlindungan\perlindunganController;
use App\Http\Controllers\resort\resortController;
use App\Http\Controllers\satwaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// route login
Route::get('/',[loginController::class,'index'])->name('home');
Route::post('login',[loginController::class,'login'])->name('login')->middleware('cors');
//
//route logout
Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');
//
//route admin
Route::prefix('admin')->group(function(){
    Route::get('dashboard',[homeController::class,'index']
    )->name('dashboard')->middleware('auth')->middleware('can:isAdmin');
    Route::get('lk',[homeController::class,'user2']
    )->name('lk')->middleware('auth')->middleware('can:isAdmin');
    Route::get('resort',[homeController::class,'user']
    )->name('resort')->middleware('auth')->middleware('can:isAdmin');
    Route::post('resort/tambah',[homeController::class,'tambahuser']
    )->name('tambahresort')->middleware('auth')->middleware('can:isAdmin');
    Route::post('lk/tambah',[homeController::class,'tambahuser2']
    )->name('tambahLK')->middleware('auth')->middleware('can:isAdmin');
    Route::post('resort/edit',[homeController::class,'edituser']
    )->name('editresort')->middleware('auth')->middleware('can:isAdmin');
    Route::post('lk/edit',[homeController::class,'edituser2']
    )->name('editLK')->middleware('auth')->middleware('can:isAdmin');
    Route::get('resort/hapus/{id}',[homeController::class,'hapususer']
    )->name('hapusresort')->middleware('auth')->middleware('can:isAdmin');
    Route::get('lk/hapus/{id}',[homeController::class,'hapususer2']
    )->name('hapusLK')->middleware('auth')->middleware('can:isAdmin');
    Route::get('satwa',[homeController::class,'satwa']
    )->name('satwa')->middleware('auth')->middleware('can:isAdmin');
    Route::get('serahan',[homeController::class,'satwaserahan']
    )->name('satwaSerahan')->middleware('auth')->middleware('can:isAdmin');
    Route::get('getJumlahsatwa',[satwaController::class,'getJumlahsatwa'])->middleware('auth')->middleware('can:isAdmin');
    Route::post('storeSatwa',[satwaController::class,'storeSatwa'])->middleware('auth')->name('storeSatwa')->middleware('can:isAdmin');
    Route::post('editSatwa',[satwaController::class,'editSatwa'])->middleware('auth')->name('editSatwa')->middleware('can:isAdmin');
    Route::post('getSatwa',[satwaController::class,'getSatwa'])->middleware('auth')->name('getSatwa')->middleware('can:isAdmin');
    Route::post('getResort',[homeController::class,'getResort'])->middleware('auth')->name('getSatwa')->middleware('can:isAdmin');
    Route::post('getLK',[homeController::class,'getLK'])->middleware('auth')->name('getSatwa')->middleware('can:isAdmin');
    Route::get('hapusSatwa/{id}',[satwaController::class,'hapusSatwa'])->middleware('auth')->name('hapusSatwa')->middleware('can:isAdmin');
    Route::get('profile',[homeController::class,'profile'])->middleware('auth')->name('profileadmin')->middleware('can:isAdmin');
    Route::post('getProfile',[homeController::class,'getProfile'])->middleware('auth')->name('getprofile')->middleware('can:isAdmin');
    Route::post('editProfile',[homeController::class,'editProfile'])->middleware('auth')->name('editprofileadmin')->middleware('can:isAdmin');
    Route::post('editPassword',[homeController::class,'editPassword'])->middleware('auth')->name('editpasswordadmin')->middleware('can:isAdmin');
});
//
Route::prefix('resort')->group(function(){
    Route::get('dashboard',[resortController::class,'index']
    )->name('dashboardR')->middleware('auth')->middleware('can:isResort');
    Route::post('storeResort',[resortController::class,'store'])->middleware('auth')->name('storeResort')->middleware('can:isResort');
    Route::post('editResort',[resortController::class,'update'])->middleware('auth')->name('editResort')->middleware('can:isResort');
    Route::post('getDataserah',[resortController::class,'getDataserah'])->middleware('auth')->name('getSerah')->middleware('can:isResort');
    Route::get('profile',[resortController::class,'profile'])->middleware('auth')->name('profileresort')->middleware('can:isResort');
    Route::any('getProfile',[resortController::class,'getProfile'])->middleware('auth')->name('getprofileresort')->middleware('can:isResort');
    Route::post('editProfile',[resortController::class,'editProfile'])->middleware('auth')->name('editprofileresort')->middleware('can:isResort');
    Route::post('editPassword',[resortController::class,'editPassword'])->middleware('auth')->name('editpasswordresort')->middleware('can:isResort');
    Route::get('tambahbaru',[resortController::class,'tambahbaru'])->middleware('auth')->name('tambahbaru')->middleware('can:isResort');
    Route::post('tambahbarustore',[resortController::class,'tambahbarustore'])->middleware('auth')->name('tambahbarustore')->middleware('can:isResort');
});
Route::prefix('perlindungan')->group(function(){
    Route::get('dashboard',[perlindunganController::class,'index']
    )->name('dashboardPL')->middleware('auth')->middleware('can:isPerlindungan');
    Route::any('printSemua',[perlindunganController::class,'printSemua'])->middleware('auth')->name('printsemua')->middleware('can:isPerlindungan');
    Route::any('cetakSemua',[perlindunganController::class,'cetakSemua'])->middleware('auth')->name('cetaksemua')->middleware('can:isPerlindungan');
    Route::any('printResort',[perlindunganController::class,'printResort'])->middleware('auth')->name('printresort')->middleware('can:isPerlindungan');
    Route::any('printLK',[perlindunganController::class,'printLK'])->middleware('auth')->name('printlk')->middleware('can:isPerlindungan');
    Route::get('profile',[perlindunganController::class,'profile'])->middleware('auth')->name('profileperlindungan')->middleware('can:isPerlindungan');
    Route::any('getProfile',[perlindunganController::class,'getProfile'])->middleware('auth')->name('getprofileperlindungan')->middleware('can:isPerlindungan');
    Route::post('editProfile',[perlindunganController::class,'editProfile'])->middleware('auth')->name('editprofileperlindungan')->middleware('can:isPerlindungan');
    Route::post('editPassword',[perlindunganController::class,'editPassword'])->middleware('auth')->name('editpasswordperlindungan')->middleware('can:isPerlindungan');
    Route::get('getJumlah',[perlindunganController::class,'getJumlah'])->middleware('auth')->name('getJumlah')->middleware('can:isPerlindungan');
});
Route::get('test',function(){
    return view('test');
});
