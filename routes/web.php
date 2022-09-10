<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class,'logout']);

Route::get('/register', [RegisterController::class,'index'])->middleware('guest');
Route::post('/register', [RegisterController::class,'store']);


Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth');
Route::get('/kendaraanmasuk', [DashboardController::class,'masuk'])->middleware('auth');
Route::post('/kendaraanmasuk', [DashboardController::class,'simpanmasuk'])->middleware('auth');

Route::get('/kendaraankeluar', [DashboardController::class,'keluar'])->middleware('auth');
Route::get('/listparkir/detail/{id_list}', [DashboardController::class,'detaillistparkir'])->middleware('auth');
Route::post('/pembayaran/{id_bayar}', [DashboardController::class,'pembayaran'])->middleware('auth');


Route::get('/laporan', [DashboardController::class,'laporan'])->middleware('auth');
Route::get('/laporanExport', [DashboardController::class,'laporanExport'])->middleware('auth');
