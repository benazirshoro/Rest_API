<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//List of all categories
Route::get('/categories', 'CategoriesController@index');

//List of all products
Route::get('/products', 'ProductsController@index');

//Create a new product
Route::post('/product', 'ProductsController@add');

//Details of a single product
Route::get('/product/{id}', 'ProductsController@show');

//Update a product details
Route::put('/product', 'ProductsController@update');

//Delete a product
Route::delete('/product/{id}', 'ProductsController@destroy');