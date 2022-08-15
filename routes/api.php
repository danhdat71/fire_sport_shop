<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SlidersController;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Location;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sliders', [SlidersController::class, 'getAllSlider']);
Route::get('/all-category', [ProductCategoriesController::class, 'getAllCategory']);
Route::get('/product-category/{url}', [ProductCategoriesController::class, 'getDetailCategory']);
Route::get('/get-products', [ProductsController::class, 'getProducts']);
Route::get('/get-blogs', [BlogsController::class, 'getBlogs']);
Route::get('/sizes', [SizeController::class, 'getAllSize']);
Route::get('/colors', [ColorController::class, 'getAllColor']);
Route::get('/product/{url}', [ProductsController::class, 'getDetailProduct']);
Route::get('/provinces', [LocationController::class, 'getProvinces']);
Route::get('/districts', [LocationController::class, 'getDistricts']);
Route::get('/towns', [LocationController::class, 'getTowns']);
Route::post('/create-bill', [BillController::class, 'createBill']);
Route::get('/blog/{url}', [BlogsController::class, 'showBlog']);