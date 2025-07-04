<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('category', [CategoryController::class, 'index'])->name('category')->middleware('permission:category-list');
    Route::get('category/listData', [CategoryController::class, 'listData'])->name('category.list')->middleware('permission:category-list');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create')->middleware('permission:category-create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store')->middleware('permission:category-create');
    Route::get('category/edit/{slug?}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('permission:category-edit');
    Route::post('category/update/{slug?}', [CategoryController::class, 'update'])->name('category.update')->middleware('permission:category-edit');
    Route::delete('category/destroy/{slug?}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('permission:category-delete');

    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [AuthController::class, 'changePassword'])->name('profile.password');

    Route::get('setting', [SettingController::class, 'index'])->name('setting')->middleware('permission:setting-list');
    Route::post('setting/update', [SettingController::class, 'update'])->name('setting.update')->middleware('permission:setting-edit');

    Route::get('service', [ServiceController::class, 'index'])->name('service')->middleware('permission:service-list');
    Route::get('service/listData', [ServiceController::class, 'listData'])->name('service.list')->middleware('permission:service-list');
    Route::get('service/add', [ServiceController::class, 'create'])->name('service.create')->middleware('permission:service-create');
    Route::post('service/store', [ServiceController::class, 'store'])->name('service.store')->middleware('permission:service-create');
    Route::get('service/edit/{slug?}', [ServiceController::class, 'edit'])->name('service.edit')->middleware('permission:service-edit');
    Route::post('service/update/{slug?}', [ServiceController::class, 'update'])->name('service.update')->middleware('permission:service-edit');
    Route::delete('service/delete/{slug?}', [ServiceController::class, 'destroy'])->name('service.destroy')->middleware('permission:service-delete');

    Route::get('about', [AboutController::class, 'index'])->name('about')->middleware('permission:about-list');
    Route::post('about/store', [AboutController::class, 'store'])->name('about.store')->middleware('permission:about-create');
    Route::post('about/update/{slug?}', [AboutController::class, 'update'])->name('about.update')->middleware('permission:about-edit');

    Route::get('permission', [PermissionController::class, 'index'])->name('permission')->middleware('permission:permission-list');
    Route::get('permission/listData', [PermissionController::class, 'listData'])->name('permission.list')->middleware('permission:permission-list');
    Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create')->middleware('permission:permission-create');
    Route::post('permission/store', [PermissionController::class, 'store'])->name('permission.store')->middleware('permission:permission-create');
    Route::get('permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit')->middleware('permission:permission-edit');
    Route::post('permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update')->middleware('permission:permission-edit');
    Route::delete('permission/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy')->middleware('permission:permission-delete');

    Route::get('role', [RoleController::class, 'index'])->name('role')->middleware('permission:role-list');
    Route::get('role/listData', [RoleController::class, 'listData'])->name('role.list')->middleware('permission:role-list');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:role-create');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store')->middleware('permission:role-create');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:role-edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update')->middleware('permission:role-edit');
    Route::delete('role/delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('permission:role-delete');

    Route::get('user', [UserController::class, 'index'])->name('user')->middleware('permission:user-list');
    Route::get('user/listData', [UserController::class, 'listData'])->name('user.list')->middleware('permission:user-list');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:user-edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('permission:user-edit');

});
