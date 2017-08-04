<?php

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


Route::get('/', [
'uses' => 'ProductsController@getDashboard',
'as' => 'dashboard'
]);

Route::get('/products/create', [
'uses' => 'ProductsController@getCreate',
'as' => 'products.get.create'
]);

Route::post('/products/create', [
'uses' => 'ProductsController@postCreate',
'as' => 'products.post.create'
]);

Route::get('products/{product_id}/edit', [
'uses' => 'ProductsController@getEdit',
'as' => 'products.get.edit'
]);

Route::post('/products/edit', [
'uses' => 'ProductsController@postEdit',
'as' => 'products.post.edit'
]);

Route::get('/products/{product_id}/delete/',[
'uses' => 'ProductsController@delete',
'as' => 'products.delete'
]);

Route::get('/products/list', [
'uses' => 'ProductsController@getList',
'as' => 'products.list'
]);

Route::get('products/{image}', [
 'uses' => 'ProductsController@getImage',
 'as'   => 'product.image'       
]);

Route::get('/search', [
 'uses' => 'ProductsController@tableSearch',
 'as' => 'search'
]);

Route::get('/login' , [
	'uses' => 'UsersController@getLogin',
	'as' => 'getLogin'
]);

Route::post('/login' , [
	'uses' => 'UsersController@postLogin',
	'as' => 'postLogin'
]);

Route::get('/logout' , [
	'uses' => 'UsersController@getLogout',
	'as' => 'getLogout'
]);
