<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\testController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SendMailController;
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
Route::get('/', ["as" => "homepage", 'uses' => 'App\Http\Controllers\ProductController@getProductsForHome']);
// Route::get('/home.html', ["as" => "homepage", 'uses' => function () {
// 	return view('home');
// }]);

Route::get('/contact.html', ["as" => "contact", 'uses' => function () {
	return view('contact');
}]);

Route::get('/today-special.html', ["as" => "today-special", 'uses' => function () {
	return view('today-special');
}]);
Route::get('/home.html', ["as" => "homepage", 'uses' => 'App\Http\Controllers\ProductController@getProductsForHome']);

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
//       CHECKOUT        //
///////////////////////////
Route::get('/checkout.html', ["as" => "checkout", 'uses' => function () {
	return view('checkout');
}]);
Route::post('/checkout/create', ["as" => "checkout-create", 'uses' => 'App\Http\Controllers\ProductController@postOrder']);

/////////////////////////////////////
//      REGISTERED USERS ONLY      //
//     since this route onward     //
/////////////////////////////////////
Route::middleware('auth')->group(function() {

Route::get('/dashboard.html', ["as" => "dashboard", 'uses' => function () {
	return view('dashboard');
}])->middleware('auth');

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

/* ORDER MANAGEMENT */

//////////////////////////////////
// View all orders
Route::get('/order-history.html', ["as" => "order-history", 'uses' => function () {
	return view('admin/order-history');
}]);

/////////////////////////////////
//Sort by day/month/year/userid/status/specific date

Route::get('/order-history-today.html', ["as" => "order-history", 'uses' => 'App\Http\Controllers\ProductController@viewOrderHistoryToday']);

Route::get('/order-history-this-month.html', ["as" => "order-history", 'uses' => 'App\Http\Controllers\ProductController@viewOrderHistoryThisMonth']);

Route::get('/order-history-this-year.html', ["as" => "order-history",'uses' => 'App\Http\Controllers\ProductController@viewOrderHistoryThisYear']);

Route::get('/order-history/{id}.html', ["as" => "order-history-by-id", 'uses' => 'App\Http\Controllers\ProductController@viewOrderHistoryByID']);

Route::get('/order-history+status={status}.html', ["as" => "order-history", 'uses' => 'App\Http\Controllers\ProductController@viewOrderHistoryByStatus']);

Route::get('/order-history-by-date/time={time}.html', ["as" => "order-history", 'uses' => 'App\Http\Controllers\ProductController@viewOrderHistoryByDate']);

/////////////////////////////////
//View an order

Route::get('/order/{id}.html', ["as" => "order-view", 'uses' => 'App\Http\Controllers\ProductController@viewOrder']);

////////////////////////////////
//Update status
Route::get('/order/update/status', ["as" => "order-update-status", 'uses' => 'App\Http\Controllers\ProductController@updateOrderStatus']);

///////////////////////////////
//Update information UI
Route::get('/order-update/{id}.html', ["as" => "order-update-ui", 'uses' => 'App\Http\Controllers\ProductController@getOrderAdmin']);

//////////////////////////////
//Update information
Route::post('/order/update', ["as" => "order-update", 'uses' => 'App\Http\Controllers\ProductController@updateOrder']);

/////////////////////////////
//Load data into Order Content UI
Route::get('/order-content-loader/{id}.html', ["as" => "order-content-loader", 'uses' => 'App\Http\Controllers\ProductController@displayOrderCart']);
//Order Content UI
Route::get('/order-content-update/{id}.html', ["as" => "product-content-update-ui", 'uses' => function () {
	return view('admin.order-content-update');
}]);

////////////////////////////
//Order Content CRUD
Route::get('/ordercart/insert', ["as" => "ordercart-insert", 'uses' => 'App\Http\Controllers\ProductController@insertOrderCart']);
Route::get('/ordercart/update', ["as" => "ordercart-update", 'uses' => 'App\Http\Controllers\ProductController@updateOrderCart']);
Route::get('/ordercart/delete', ["as" => "ordercart-delete", 'uses' => 'App\Http\Controllers\ProductController@deleteOrderCart']);
Route::get('/ordercart/destroy', ["as" => "ordercart-destroy", 'uses' => 'App\Http\Controllers\ProductController@destroyOrderCart']);
Route::get('/ordercart/submit', ["as" => "ordercart-submit", 'uses' => 'App\Http\Controllers\ProductController@postOrderCart']);

/* DISCOUNT MANAGEMENT - to be implemented */

});
/////////////////////////////////////
//  end of REGISTERED USERS ONLY   //
//     since this route upward     //
/////////////////////////////////////


///////////////////////////
//PAYPAL

Route::get('/paypal/thanh-toan', ["as" => "paypal-thanhtoan", 'uses' => 'App\Http\Controllers\PaypalController@thanhToan']);
Route::get('/paypal/status', ["as" => "paypal-status", 'uses' => 'App\Http\Controllers\PaypalController@status'] );

//Analize
Route::get('/analize.html', ["as" => "Analize", 'uses' => 'App\Http\Controllers\ProductController@analize']);
//////////////////////////
//TWILIO


//////////////////////////
//    MISCELLANEOUS     //
//////////////////////////
//Route::view('/register', 'register');
//Route::post('/register', [registerController::class, 'registerFunction']);
//Route::get('/test', ["as" => "test", 'uses' => 'App\Http\Controllers\CartController@getCart']);

//Route::get('/product/{id}', [ProductController::class,'deleteProduct']);