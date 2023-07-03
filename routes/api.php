<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogShipmentController;
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

Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [LoginController::class, 'register']);
    Route::get('/info', [LoginController::class, 'info']);

    // api
    Route::middleware('auth:api')->group(function () {
        // user
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::put('/{user}', [UserController::class, 'update']);
            Route::delete('/{user}', [UserController::class, 'destroy']);
        });
        // product
        Route::prefix('package')->group(function () {
            Route::get('/', [PackageController::class, 'index']);
            Route::post('/', [PackageController::class, 'store']);
            Route::get('/{package}', [PackageController::class, 'show']);
            Route::put('/{package}', [PackageController::class, 'update']);
            Route::delete('/{package}', [PackageController::class, 'destroy']);
        });
        // shipment
        Route::prefix('shipment')->group(function () {
            Route::get('/', [ShipmentController::class, 'index']);
            Route::post('', [ShipmentController::class, 'store']);
            Route::get('/{shipment}', [ShipmentController::class, 'show']);
            Route::put('/{shipment}', [ShipmentController::class, 'update']);
            Route::delete('/{shipment}', [ShipmentController::class, 'destroy']);
        });
        // log shipment
        Route::prefix('log-shipment')->group(function () {
            Route::get('/', [LogShipmentController::class, 'index']);
        });
    });
});
