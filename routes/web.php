<?php
// routes/web.php
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
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
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile Routes (basic access for all authenticated users)
    Route::get('/profile/show', [UserController::class, 'showProfile'])->name('profile.showProfile');
    
    // User Management Routes
    Route::middleware(['permission:user.view'])->group(function () {
        Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
        Route::get('/profile/{profile}', [UserController::class, 'show'])->name('profile.show');
    });
    
    Route::middleware(['permission:user.create'])->group(function () {
        Route::get('/profile/create', [UserController::class, 'create'])->name('profile.create');
        Route::post('/profile', [UserController::class, 'store'])->name('profile.store');
    });
    
    Route::middleware(['permission:user.edit'])->group(function () {
        Route::get('/profile/{profile}/edit', [UserController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{profile}', [UserController::class, 'update'])->name('profile.update');
    });
    
    Route::middleware(['permission:user.delete'])->group(function () {
        Route::delete('/profile/{profile}', [UserController::class, 'destroy'])->name('profile.destroy');
    });

    // Role Management Routes
    Route::middleware(['permission:role.view'])->group(function () {
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    });
    
    Route::middleware(['permission:role.create'])->group(function () {
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
    });
    
    Route::middleware(['permission:role.edit'])->group(function () {
        Route::get('/role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/role/{role}', [RoleController::class, 'update'])->name('role.update');
    });
    
    Route::middleware(['permission:role.delete'])->group(function () {
        Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
    });

    // Permission Management Routes
    Route::middleware(['permission:permission.index'])->group(function () {
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    });
    
    Route::middleware(['permission:permission.create'])->group(function () {
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    });
    
    Route::middleware(['permission:permission.update'])->group(function () {
        Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    });
    
    Route::middleware(['permission:permission.delete'])->group(function () {
        Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    // Activity Logs
    Route::middleware(['permission:user.report'])->group(function () {
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    });
});