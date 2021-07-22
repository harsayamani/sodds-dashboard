<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\RulesController;

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
Route::get('/admin/logout', [AdminController::class, 'logout']);
Route::get('/admin/change-password', [AdminController::class, 'changePassword']);
Route::post('/admin/change-password/process', [AdminController::class, 'changePasswordProcess']);

Route::get('/admin/diagnosis/test', [DiagnosisController::class, 'diagnosisTest']);
Route::get('/admin/diagnosis/history', [DiagnosisController::class, 'diagnosisHistory']);
Route::get('/admin/diagnosis/history/get-all-diagds', [DiagnosisController::class, 'diagDSHistory']);
Route::get('/admin/diagnosis/history/get-all-diagcf', [DiagnosisController::class, 'diagCFHistory']);
Route::get('/admin/diagnosis/history', [DiagnosisController::class, 'diagnosisHistory']);
Route::post('/admin/diagnosis/process', [DiagnosisController::class, 'diagnosisProcess']);
Route::post('/admin/diagnosiscf/process', [DiagnosisController::class, 'diagnosiscfProcess']);
Route::post('/admin/evidence/get-evidence', [DiagnosisController::class, 'getEvidence']);

Route::get('/admin/manage/evidence', [EvidenceController::class, 'manageEvidence']);
Route::post('/admin/manage/evidence/add', [EvidenceController::class, 'addEvidence']);
Route::post('/admin/manage/evidence/update', [EvidenceController::class, 'updateEvidence']);
Route::post('/admin/manage/evidence/delete', [EvidenceController::class, 'deleteEvidence']);

Route::get('/admin/manage/disease', [DiseaseController::class, 'manageDisease']);
Route::post('/admin/manage/disease/add', [DiseaseController::class, 'addDisease']);
Route::post('/admin/manage/disease/update', [DiseaseController::class, 'updateDisease']);
Route::post('/admin/manage/disease/delete', [DiseaseController::class, 'deleteDisease']);

Route::get('/admin/manage/rules-ds', [RulesController::class, 'manageRulesds']);
Route::post('/admin/manage/rules-ds/add', [RulesController::class, 'addRulesDS']);
Route::post('/admin/manage/rules-ds/update', [RulesController::class, 'updateRulesDS']);
Route::post('/admin/manage/rules-ds/delete', [RulesController::class, 'deleteRulesDS']);

Route::get('/admin/manage/rules-cf', [RulesController::class, 'manageRulescf']);
Route::post('/admin/manage/rules-cf/add', [RulesController::class, 'addRulesCF']);
Route::post('/admin/manage/rules-cf/update', [RulesController::class, 'updateRulesCF']);
Route::post('/admin/manage/rules-cf/delete', [RulesController::class, 'deleteRulesCF']);
