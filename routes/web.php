<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Jabatan;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']],function(){
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/pegawai/data', 'PegawaiController@data')->name('pegawai.data');
    Route::get('/pegawai/editbiodata', 'PegawaiController@editbiodata')->name('pegawai.editbiodata');
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('tunjangan', TunjanganController::class);
    Route::resource('potongan', PotonganController::class);
    Route::patch('/izin/confirm/{id}', 'IzinController@confirm')->name('izin.confirm');
    Route::resource('izin', IzinController::class);
});



Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
