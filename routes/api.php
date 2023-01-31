<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AuthController;

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

// Private routes
    // Route for products
Route::resource('products', ProductController::class)->middleware('auth:sanctum');

    // Route for categories
Route::resource('categories', CategoryController::class)->middleware('auth:sanctum');

    // Route for brands
Route::resource('brands', BrandController::class)->middleware('auth:sanctum');

    // Routes to get products for a certain category or brand
Route::get('categories/products/{id}', [CategoryController::class, 'getProductsByCategory'])->middleware('auth:sanctum');
Route::get('brands/products/{id}', [BrandController::class, 'getProductsByBrand'])->middleware('auth:sanctum');

    // Route to logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// Public routes
    // Route to register user
Route::post('/register', [AuthController::class, 'register']);
    // Route to login user
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
