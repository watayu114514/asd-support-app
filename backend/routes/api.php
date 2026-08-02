<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\DifficultyRecordController;
use App\Http\Controllers\DifficultyStatisticsController;

Route::post('/register', [AuthController::class, 'register']);

Route::get('/user', [UserController::class, 'show'])
    ->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [UserProfileController::class, 'show']);
    Route::post('/profile', [UserProfileController::class, 'store']);
    Route::put('/profile', [UserProfileController::class, 'update']);


    // 困りごと一覧
    Route::get('/difficulties', [DifficultyRecordController::class, 'index']);

    // 登録
    Route::post('/difficulties', [DifficultyRecordController::class, 'store']);


    // ★ 固定URLは先
    Route::get(
        '/difficulties/statistics',
        [DifficultyStatisticsController::class, 'index']
    );


    // ★ {id} は最後
    Route::get('/difficulties/{id}', [DifficultyRecordController::class, 'show']);
    Route::put('/difficulties/{id}', [DifficultyRecordController::class, 'update']);
    Route::delete('/difficulties/{id}', [DifficultyRecordController::class, 'destroy']);

});