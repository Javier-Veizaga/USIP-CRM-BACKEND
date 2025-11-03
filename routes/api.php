<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
