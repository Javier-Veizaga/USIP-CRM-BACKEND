<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/test', fn () => response()->json(['ok' => true]));
Route::apiResource('users', UserController::class);
