<?php

use App\Http\Controllers\Api\MockMagentoController;
use App\Http\Controllers\API\ProductsController;
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

Route::get('/mock-magento/products', [MockMagentoController::class, 'products']);
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{id}', [ProductsController::class, 'show']);
Route::post('/products/sync', [ProductsController::class, 'syncProducts']);
Route::post('/orders', function(Request $request) {
    return response()->json([
        'received' => $request->all()
    ]);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
