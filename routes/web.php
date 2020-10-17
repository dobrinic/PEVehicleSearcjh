<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\VehicleController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('search', [HomeController::class, 'search'])->name('search');

Route::post('vehicles/import', [VehicleController::class, 'import'])->name('vehicles.import');
Route::post('parts/import', [PartController::class, 'import'])->name('parts.import');
