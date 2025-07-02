<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [AuthController::class, 'changePassword'])->name('profile.password');

    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::post('setting/update', [SettingController::class, 'update'])->name('setting.update');

    Route::get('service', [ServiceController::class, 'index'])->name('service');
    Route::get('service/listData', [ServiceController::class, 'listData'])->name('service.list');
    Route::get('service/add', [ServiceController::class, 'create'])->name('service.create');
    Route::post('service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('service/edit/{slug?}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('service/update/{slug?}', [ServiceController::class, 'update'])->name('service.update');
    Route::get('service/delete/{slug?}', [ServiceController::class, 'destroy'])->name('service.destroy');
});
