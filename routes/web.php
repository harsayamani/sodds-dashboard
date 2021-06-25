<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiagnosisController;

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
    return redirect('/admin/login');
});

Route::get('/admin/login', [AdminController::class, 'loginIndex']);
Route::post('/admin/login/process', [AdminController::class, 'loginProcess']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::post('/admin/logout', [AdminController::class, 'logout']);

Route::get('/admin/diagnosis/test', [DiagnosisController::class, 'diagnosisTest']);
Route::get('/admin/diagnosis/history', [DiagnosisController::class, 'diagnosisHistory']);
Route::get('/admin/diagnosis/history/get-all-diagds', [DiagnosisController::class, 'diagDSHistory']);
Route::get('/admin/diagnosis/history/get-all-diagcf', [DiagnosisController::class, 'diagCFHistory']);
Route::get('/admin/diagnosis/history', [DiagnosisController::class, 'diagnosisHistory']);
Route::post('/admin/diagnosis/process', [DiagnosisController::class, 'diagnosisProcess']);
Route::post('/admin/diagnosiscf/process', [DiagnosisController::class, 'diagnosiscfProcess']);
Route::post('/admin/evidence/get-evidence', [DiagnosisController::class, 'getEvidence']);
