<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\testController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//////////////////////////
//  PUBLIC DIRECTORIES  //
//////////////////////////
Route::get('/', ["as" => "homepage", 'uses' => function () {
	return view('home');
}]);
Route::get('/home', ["as" => "homepage", 'uses' => function () {
	return view('home');
}]);

Route::get('/contact.html', ["as" => "contact", 'uses' => function () {
	return view('contact');
}]);

Route::get('/today-special.html', ["as" => "today-special", 'uses' => function () {
	return view('today-special');
}]);

Route::get('/products.html', ["as" => "products", 'uses' => 'App\Http\Controllers\ProductController@getProducts']);

Route::get('/product/{id}.html', ["as" => "product", 'uses' => 'App\Http\Controllers\ProductController@viewProduct']);

//////////////////////////
//         CART         //
//////////////////////////

Route::get('/cart.html', ["as" => "cart", 'uses' => 'App\Http\Controllers\ProductController@displayCart']);
Route::get('/cart/insert', ["as" => "cart-insert", 'uses' => 'App\Http\Controllers\ProductController@insertCart']);
Route::get('/cart/update', ["as" => "cart-update", 'uses' => 'App\Http\Controllers\ProductController@updateCart']);
Route::get('/cart/delete', ["as" => "cart-delete", 'uses' => 'App\Http\Controllers\ProductController@deleteCart']);
Route::get('/cart/destroy', ["as" => "cart-destroy", 'uses' => 'App\Http\Controllers\ProductController@destroyCart']);

//////////////////////////
//    AUTHENTICATION    //
//////////////////////////
Route::get('/login.html', ["as" => "login", 'uses' => function () {
	return view('login');
}]);
Route::post('/login/authenticate', ["as" => "user-authenticate", 'uses' => 'App\Http\Controllers\UserController@login']);

Route::get('/logout', ["as" => "logout", 'uses' => 'App\Http\Controllers\UserController@logout']);

Route::get('/signup.html', ["as" => "signup", 'uses' => function () {
	return view('signup');
}]);

Route::post('/signup/store', ["as" => "user-store", 'uses' => 'App\Http\Controllers\UserController@store']);

///////////////////////////
// REGISTERED USERS ONLY //
///////////////////////////
Route::get('/dashboard.html', function () {
	return view('dashboard');
})->middleware('auth');

//////////////////////////
// ADMINISTRATORS ONLY  //
//////////////////////////

/* PRODUCT MANAGEMENT */

Route::get('/product-list.html', ["as" => "product-list", 'uses' => function () {
	return view('admin/product-list');
}]);

Route::get('/product-view/{id}.html', ["as" => "product-view", 'uses' => 'App\Http\Controllers\ProductController@viewProductAdmin']);

Route::get('/product-create.html', ["as" => "product-create-ui", 'uses' => function () {
	return view('admin/product-create');
}]);
Route::post('/product/create', ["as" => "product-create", 'uses' => 'App\Http\Controllers\ProductController@createProduct']);

Route::get('/product-edit/{id}.html', ["as" => "product-edit-ui", 'uses' => 'App\Http\Controllers\ProductController@getProductAdmin']);
Route::post('/product/update', ["as" => "product-update", 'uses' => 'App\Http\Controllers\ProductController@updateProduct']);

Route::get('/product/delete', ["as" => "product-delete", 'uses' => 'App\Http\Controllers\ProductController@deleteProduct']);

/* USER MANAGEMENT */

Route::get('/user-list.html', ["as" => "user-list", 'uses' => function () {
	return view('admin/user-list');
}]);

Route::get('/user/{id}.html', ["as" => "user-view", 'uses' => 'App\Http\Controllers\UserController@view']);

Route::get('/user/promote/{id}', ["as" => "user-promote", 'uses' => 'App\Http\Controllers\UserController@promote']);
Route::get('/user/demote/{id}', ["as" => "product-demote", 'uses' => 'App\Http\Controllers\UserController@demote']);

//////////////////////////
//    MISCELLANEOUS     //
//////////////////////////
//Route::view('/register', 'register');
//Route::post('/register', [registerController::class, 'registerFunction']);
//Route::get('/test', [testController::class, 'test']);

//Route::get('/product/{id}', [ProductController::class,'deleteProduct']);