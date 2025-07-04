<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\AboutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/category', [CategoryController::class, 'index']);
Route::get('/category/{slug}', [CategoryController::class, 'show']);

Route::post('/service', [ServiceController::class, 'index']);
Route::post('/service/{slug}', [ServiceController::class, 'show']);

Route::get('/about', [AboutController::class, 'index']);
Route::get('/about/{slug}', [AboutController::class, 'show']);

Route::post('/settings', [SettingController::class, 'index']);
