<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\studentScoresController;

Route::middleware(['auth:sanctum'])->group(function () {    
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/getData', [studentScoresController::class, 'index']);
});


Route::post('/register', [AuthController::class, 'RegisterUser']);
Route::post('/login', [AuthController::class, 'login']);