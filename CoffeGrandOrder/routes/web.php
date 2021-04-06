<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\testController;
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



Route::get('/', ["as" => "homepage", 'uses' => function () {	
	return view('Homepage');
}]);

Route::get('/home.html', ["as" => "home", 'uses' => function () {	
	return view('home');
}]);

Route::get('/contact.html', ["as" => "contact", 'uses' => function () {	
	return view('contact');
}]);

Route::get('/today-special.html', ["as" => "today-special", 'uses' => function () {	
	return view('today-special');
}]);

Route::get('/menu.html', ["as" => "menu", 'uses' => function () {	
	return view('Menu');
}]);

Route::get('/login.html', ["as" => "login", 'uses' => function () {	
	return view('login');
}]);
Route::post('/login/authenticate', ["as" => "user-authenticate", 'uses' => 'App\Http\Controllers\UserController@login']);

Route::get('/logout', ["as" => "logout", 'uses' => 'App\Http\Controllers\UserController@logout']);

Route::get('/signup.html', ["as" => "signup", 'uses' => function () {	
	return view('signup');
}]);

Route::post('/signup/store', ["as" => "user-store", 'uses' => 'App\Http\Controllers\UserController@store']);

Route::get('/dashboard.html', function () {
	return view('dashboard');
})->middleware('auth');


Route::get('/products.html', ["as" => "products", 'uses' => 'App\Http\Controllers\productControllers\ProductController@getProducts']);
Route::get('/product/{id}.html', ["as" => "product", 'uses' => 'App\Http\Controllers\productControllers\ProductController@viewProduct']);
/*
Route::get('/dashboard.html', ["as" => "dashboard", 'uses' => function () {	
	return view('dashboard');
}]);
*/
//--- Open Router register ---//
Route::view('/register', 'register');
Route::post('/register',[registerController::class, 'registerFunction']);

//Route::get('/test', [testController::class, 'test']);
//--- End Router register ---//
