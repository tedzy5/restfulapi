<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('products/{id}', [ProductsController::class, 'destroy']);
    Route::put('products/{id}', [ProductsController::class, 'update']);
    Route::post('products', [ProductsController::class, 'store']);
    Route::get('/products/search/{name}', [ProductsController::class, 'search']);
});

Route::post('register', [UsersController::class, 'register']);
Route::apiResource('clients', ClientsController::class);
Route::apiResource('employees', EmployeesController::class);
Route::apiResource('products', ProductsController::class);

