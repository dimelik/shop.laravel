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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'MainController@index')->name('index');

Route::get('/basket', 'BasketController@basket')->name('basket');

Route::get('/categories', 'MainController@categories')->name('categories');

Route::get('/order', 'BaController@order')->name('order');

Route::post('/basket/add/{id}', 'BasketController@basketAdd')->name('basket-add');

Route::get('/{category?}', 'MainController@category')->name('category');

Route::get('/{category}/{product?}', 'MainController@product')->name('product');











Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
