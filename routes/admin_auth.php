<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VibeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/create-storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    if (file_exists($link)) {
        return 'Storage link already exists.';
    }

    if (symlink($target, $link)) {
        return 'Storage link created successfully.';
    } else {
        return 'Failed to create storage link. Your server may not support symlinks.';
    }
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');

    return 'Application cache and config cache cleared successfully.';
});

// Guest admin routes
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'store']);
});

// Authenticated admin routes
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // vibes routes
    Route::post('/vibes/toggle-status/{id}', [VibeController::class, 'toggleStatus'])
        ->name('vibes.toggleStatus');
    Route::get('/vibes', [VibeController::class, 'index'])->name('vibes.index');
    Route::post('/vibes', [VibeController::class, 'store'])->name('vibes.store');
    Route::get('/vibes/edit/{vibe}', [VibeController::class, 'edit'])->name('vibes.edit');
    Route::put('/vibes/{vibe}', [VibeController::class, 'update'])->name('vibes.update');
    Route::delete('/vibes/{vibe}', [VibeController::class, 'destroy'])->name('vibes.destroy');

    Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');
});
