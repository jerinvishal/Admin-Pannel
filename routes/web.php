<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController; // Fixed casing
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->name('welcome');

// Register
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

// Login
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.perform');

// Dashboard
Route::get('/dashboard', function () {
    return view('layout.dashboard');
})->middleware('auth')->name('dashboard');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [UserController::class, 'create'])->name('profile.create'); // Fixed here
    Route::post('/profile', [UserController::class, 'store'])->name('profile.store');
    Route::get('/profile/show', [UserController::class, 'showProfile'])->name('profile.showProfile');
    Route::get('/profile/{profile}', [UserController::class, 'show'])->name('profile.show');
    Route::get('/profile/{profile}/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{profile}', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{profile}', [UserController::class, 'destroy'])->name('profile.destroy');

    // Role Routes
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::get('/role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');


    //Activity Log

     Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
});
