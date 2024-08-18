<?php

use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\BoardController;
use App\Http\Controllers\API\NewRecruitController;
use App\Http\Controllers\MinatureController;

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])
  ->middleware('auth:sanctum');


Route::resource('boards', BoardController::class)->middleware('auth:sanctum');

Route::post('newRecruit/upload', [NewRecruitController::class, 'upload']);
Route::get('minatures', [MinatureController::class, 'index']);