<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DataBasisPengetahuanController;
use App\Http\Controllers\Backend\DataGejalaController;
use App\Http\Controllers\Backend\DataPenyakitController;
use App\Http\Controllers\Backend\DataRiwayatController;
use App\Http\Controllers\Frontend\DiagnosaController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PedomanController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('login');
    Route::get('diagnosa', [DiagnosaController::class, 'index']);
    Route::post('diagnosa', [DiagnosaController::class, 'kalkulator']);
    Route::get('diagnosa/{data_diagnosa}', [DiagnosaController::class, 'showdata']);
    Route::get('pedoman', [PedomanController::class, 'index']);
    Route::get('login', [LoginController::class, 'index']);
    Route::post('login', [LoginController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::resource('data-penyakit', DataPenyakitController::class)->except('show');
    Route::resource('data-gejala', DataGejalaController::class)->except('show');
    Route::resource('data-basis-pengetahuan', DataBasisPengetahuanController::class)->except('show');
    Route::get('data-riwayat', [DataRiwayatController::class, 'index']);
    Route::get('data-riwayat/{id_diagnosa}', [DataRiwayatController::class, 'showdata']);
    Route::delete('data-riwayat/{id_diagnosa}', [DataRiwayatController::class, 'destroy']);
    Route::post('logout', [LoginController::class, 'logout']);
});
