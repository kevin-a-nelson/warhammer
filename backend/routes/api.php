<?php

use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\BoardController;
use App\Http\Controllers\BoardUserController;

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])
  ->middleware('auth:sanctum');


Route::resource('boards', BoardController::class)->middleware('auth:sanctum');
Route::resource('boardUsers', BoardUserController::class)->middleware('auth:sanctum');