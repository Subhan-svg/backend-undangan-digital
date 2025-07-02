<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('category/listData', [CategoryController::class, 'listData'])->name('category.list');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{slug?}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update/{slug?}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/destroy/{slug?}', [CategoryController::class, 'destroy'])->name('category.destroy');

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

    Route::get('about', [AboutController::class, 'index'])->name('about');
    Route::get('about/add', [AboutController::class, 'create'])->name('about.create');
    Route::post('about/store', [AboutController::class, 'store'])->name('about.store');
    Route::get('about/edit/{slug?}', [AboutController::class, 'edit'])->name('about.edit');
    Route::post('about/update/{slug?}', [AboutController::class, 'update'])->name('about.update');
    Route::get('about/delete/{slug?}', [AboutController::class, 'destroy'])->name('about.delete');
    Route::get('about/getListData', [AboutController::class, 'listData'])->name('about.list');

});
