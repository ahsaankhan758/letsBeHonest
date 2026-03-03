<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;


$currentPrefix = request()->segment(1);
if($currentPrefix == 'admin'){
    Route::prefix('admin')->group(function () {     
        require __DIR__.'/admin_auth.php';
    });
}

require __DIR__.'/auth.php';

// Front End Manage Donations and Trees
if($currentPrefix == 'my'){
    Route::prefix('my')->middleware('frontEndAuth')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
}

//Front End React Routes
Route::get('/', [DashboardController::class, 'react'])->name('react');


// Dashboard Routes


Route::view('/{any}', 'app')->where('any', '.*');