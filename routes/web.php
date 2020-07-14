<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostalWorkerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Middleware\PostalWorker;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'ProductController@index')->name('dashboard');
Route::get('/product-details/{id}', 'ProductController@productDetails')->name('product-details');
Route::post('/track', 'ProductController@trackOrder')->name('order.track');
Route::get('/track', 'ProductController@trackView')->name('order.track.view');

Auth::routes();
Route::get('register/buyer', 'Auth\RegisterController@showBuyerRegistrationForm')->name('registerBuyer');
Route::post('register/buyer', 'Auth\RegisterController@registerBuyer');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/workers', 'AdminController@showAllWorkers')->name('workers');
    Route::get('/clients', 'AdminController@showAllClients')->name('clients');
    Route::get('/all_orders', 'AdminController@list_orders')->name('admin.allOrders');
    Route::get('/new_orders', 'AdminController@list_new_orders')->name('admin.newOrders');
    Route::get('/delivered_orders', 'AdminController@list_delivered_orders')->name('admin.deliveredOrders');
    Route::patch('/new_orders/choosePostalWorker/{id}', 'OrderController@choosePostalWorker')->name('choosePostalWorker');
    Route::get('all_orders/{id}', 'AdminController@showOrder')->name('viewOrder');
    Route::get('delivered_orders/{id}', 'AdminController@showDeliveredOrder')->name('viewDeliveredOrder');
    Route::get('all_orders/editPostalWorker/{id}', 'OrderController@editPostalWorker')->name('editPostalWorker');
    Route::patch('all_orders/editPostalWorker/{id}', 'OrderController@updatePostalWorker')->name('updatePostalWorker');
    Route::get('/settings', 'AdminController@post_settings')->name('admin.settings');
    Route::delete('/clients/{client}', 'PostalClientsController@destroy')->name('postalclient.destroy');
    Route::resource('/postalworker', 'PostalWorkerController');
    Route::get('/postalsettings', 'PostalSettingsController@index')->name('postalsettings');
    Route::patch('/postalsettings/{settings}', 'PostalSettingsController@update');
    Route::patch('/disableacc/{id}', 'AdminController@disableAccount')->name('disableacc');
    Route::get('/addworker', 'PostalWorkerController@create')->name('addworker');
    Route::post('/addworker', 'PostalWorkerController@store')->name('post.addworker');
    Route::get('/ordersof/{sellerId}', 'PostalClientsController@allOrders')->name('ordersof');
    Route::get('/users/{id}', 'AdminController@generateContract')->name('workerContract');
    Route::post('/search_clients', 'AdminController@searchClients')->name('searchClients');
    Route::get('/search_clients', 'AdminController@searchClients')->name('searchClients');
});

Route::group(['middleware' => ['seller']], function () {
    Route::get('/seller', 'SellerController@index')->name('seller');
    Route::get('/orders', 'OrderController@index')->name('list_orders');
    Route::get('/order', 'OrderController@create')->name('order');
    Route::post('/order', 'OrderController@store');
    Route::get('/report/{id}', 'OrderController@downloadReport')->name('report');
    Route::get('/newProduct', 'ProductController@create')->name('newProduct');
    Route::post('/newProduct', 'ProductController@store')->name('addProduct');
});


Route::group(['middleware' => ['postal_worker']], function () {
    Route::get('/postalworker', 'PostalWorkerController@index')->name('postalworker');
    Route::get('/postalworker/delivered_orders', 'PostalWorkerController@listDeliveredOrders')->name('listDeliveredOrders');
    Route::patch('/postalworker/changeOrderStatus/{id}', 'PostalWorkerController@changeOrderStatus')->name('changeOrderStatus');
});

Route::group(['middleware' => ['buyer']], function () {
    Route::get('/buyer', 'BuyerController@index')->name('buyer');
    Route::get('/cart', 'BuyerController@loadCart')->name('cart');
    Route::post('/cart/{id}', 'BuyerController@addToCart')->name('cart');
    Route::delete('/product/{id}', 'ProductController@destroy')->name('product.destroy');
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
    //Route::get('/checkoutProduct/{id}', 'CheckoutController@show')->name('checkout.index');
    Route::get('/thankyou', 'CheckoutController@thankyou')->name('thankyou');
});

// Route::get('productDetails/{id}', 'ProductController@showProductDetails')->name('productDetails');
