<?php
 
use App\Http\Controllers\Api\FollowUserController;
use App\Http\Controllers\Api\GetVibesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;




 
Route::middleware('api')->group(function () {
    // Authentication
    Route::post('store', [AuthenticatedSessionController::class, 'store']);
    Route::post('getRegistered', [RegisteredUserController::class, 'store']);
    Route::post('storeLogin', [AuthenticatedSessionController::class, 'storeLogin']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);

    // Follow Users
    Route::get('followUser', [FollowUserController::class, 'followUser']);

    // Get Vibes
    Route::get('getVibes', [GetVibesController::class, 'getVibes']);

});