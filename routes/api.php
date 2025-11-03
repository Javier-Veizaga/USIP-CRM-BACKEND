<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\ActionCatalogController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('action-catalog', ActionCatalogController::class);