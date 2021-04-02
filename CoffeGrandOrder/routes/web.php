<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home.html', ["as" => "home", 'uses' => function () {	
	return view('home');
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

/*
Route::get('/dashboard.html', ["as" => "dashboard", 'uses' => function () {	
	return view('dashboard');
}]);
*/