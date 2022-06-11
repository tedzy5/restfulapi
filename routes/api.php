<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProductsController;
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

Route::apiResource('clients', ClientsController::class);
Route::apiResource('employees', EmployeesController::class);
Route::apiResource('products', ProductsController::class);
Route::get('/products/search/{name}', [ProductsController::class, 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



/*Route::get('clients', [ClientsController::class, 'getClients']);
Route::get('employees', [EmployeesController::class, 'getEmployees']);
Route::get('products', [ProductsController::class, 'getProducts']);

Route::get('client/{id}', [ClientsController::class, 'getClient']);
Route::get('employee/{id}', [EmployeesController::class, 'getEmployee']);
Route::get('product/{id}', [ProductsController::class, 'getProduct']);

Route::post('client', [ClientsController::class, 'addClient']);
Route::post('employee', [EmployeesController::class, 'addEmployee']);
Route::post('product', [ProductsController::class, 'addProduct']);

Route::put('client/{id}', [ClientsController::class, 'updateClient']);
Route::put('employee/{id}', [EmployeesController::class, 'updateEmployee']);
Route::put('product/{id}', [ProductsController::class, 'updateProduct']);*/
