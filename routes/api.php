<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\ShipmentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [LoginController::class, 'register']);
    Route::get('/info', [LoginController::class, 'info']);

    // api
    Route::middleware('auth:api')->group(function () {
        // user
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/store', [UserController::class, 'store']);
            Route::get('/show/{id}', [UserController::class, 'show']);
            Route::put('/update/{id}', [UserController::class, 'update']);
            Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
        });
        // product
        Route::prefix('package')->group(function () {
            Route::get('/', [PackageController::class, 'index']);
            Route::post('/store', [PackageController::class, 'store']);
            Route::get('/show/{id}', [PackageController::class, 'show']);
            Route::put('/update/{id}', [PackageController::class, 'update']);
            Route::delete('/destroy/{id}', [PackageController::class, 'destroy']);
        });
        Route::prefix('shipment')->group(function () {
            Route::get('/', [ShipmentController::class, 'index']);
            Route::post('/store', [ShipmentController::class, 'store']);
            Route::get('/show/{id}', [ShipmentController::class, 'show']);
            Route::put('/update/{id}', [ShipmentController::class, 'update']);
            Route::delete('/destroy/{id}', [ShipmentController::class, 'destroy']);
        });
    });
});
