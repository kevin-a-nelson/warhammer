<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;


Route::post('/login', [LoginController::class, 'login']);
Route::get('/protected-endpoint', [LoginController::class, 'protectedEndpoint']);
Route::post('/users', [UserController::class, 'create']);
