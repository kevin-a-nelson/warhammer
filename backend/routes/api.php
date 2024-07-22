<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\LoginController;


Route::post('/login', [LoginController::class, 'login']);
Route::get('/protected-endpoint', [LoginController::class, 'protectedEndpoint']);
