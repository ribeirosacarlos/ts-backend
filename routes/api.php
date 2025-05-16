<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToDoListController;
use App\Http\Controllers\TaskController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::apiResource('to-do-lists', ToDoListController::class);
    Route::apiResource('tasks', TaskController::class)->except(['index', 'show']);
});