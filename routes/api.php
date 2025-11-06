<?php

use App\Http\Controllers\ActionCatalogController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\DataSourceController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SchoolShiftController;
use App\Http\Controllers\SchoolManagementController;
use App\Http\Controllers\AgreementTypeController;
use App\Http\Controllers\AgreementStatusController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;


Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('action-catalog', ActionCatalogController::class);
Route::apiResource('responses', ResponseController::class);
Route::apiResource('statuses', StatusController::class);
Route::apiResource('data-sources', DataSourceController::class);
Route::apiResource('faculties', FacultyController::class);
Route::apiResource('school-shifts', SchoolShiftController::class);
Route::apiResource('school-managements', SchoolManagementController::class);
Route::apiResource('agreement-types', AgreementTypeController::class);
Route::apiResource('agreement-statuses', AgreementStatusController::class);
Route::apiResource('schools', SchoolController::class);
Route::apiResource('courses', CourseController::class);
//Ruta para ronal,
Route::get('courses/meta', [CourseController::class, 'meta']);