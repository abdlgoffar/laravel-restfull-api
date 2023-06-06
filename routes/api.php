<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

use App\Http\Middleware\EnsureTokenIsValid;
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


/**
 * route product controller config
 */
Route::get('/products', 'App\Http\Controllers\Api\ProductController@index');
Route::get('/products/{id}', 'App\Http\Controllers\Api\ProductController@show');
Route::post('/products', 'App\Http\Controllers\Api\ProductController@store');
Route::put('/products/{id}', 'App\Http\Controllers\Api\ProductController@update');
Route::delete('/products/{id}', 'App\Http\Controllers\Api\ProductController@destroy');
/**
 * route category controller config
 */
Route::get('/categories', 'App\Http\Controllers\Api\CategoryController@index');
Route::get('/categories/{id}', 'App\Http\Controllers\Api\CategoryController@show');
Route::post('/categories', 'App\Http\Controllers\Api\CategoryController@store');
Route::put('/categories/{id}', 'App\Http\Controllers\Api\CategoryController@update');
Route::delete('/categories/{id}', 'App\Http\Controllers\Api\CategoryController@destroy');
