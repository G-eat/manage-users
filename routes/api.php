<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserEloquentController;

Route::apiResource('users/eloquent',    UserEloquentController::class)->parameters(['eloquent' => 'user']);
Route::apiResource('users',             UserController::class);

