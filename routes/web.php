<?php

use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [EvaluationController::class, 'index']);
Route::get('/export/{id}', [EvaluationController::class, 'exportExcel'])->name('exportExcel');
Route::get('/exportCSV/{id}', [EvaluationController::class, 'exportCSV'])->name('exportCSV');