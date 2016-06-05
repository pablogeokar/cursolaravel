<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return redirect('admin/products');
});

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::pattern('id', '[0-9]+');

Route::group(['prefix' => 'admin', 'middleware' => 'web'], function () {
    Route::get('categories/',['as' => 'categories', 'uses' =>'AdminCategoriesController@index']);    
    Route::get('categories/create/', ['as' => 'categories.create',  'uses' => 'AdminCategoriesController@getCreate']);
    Route::get('categories/{id?}/destroy', ['as' => 'categories.destroy', 'uses' => 'AdminCategoriesController@destroy']);
    Route::get('categories/{id?}/edit', ['as' => 'categories.edit', 'uses' => 'AdminCategoriesController@edit']);
    Route::post('categories', 'AdminCategoriesController@store');
    Route::put('categories/{id?}/update', ['as' => 'categories.update', 'uses' => 'AdminCategoriesController@update']);

    Route::get('products/', 'AdminProductsController@index');
    Route::get('products/insert', 'AdminProductsController@getInsert');
    Route::get('products/{id?}/destroy', 'AdminProductsController@destroy');
    Route::get('products/edit/{id?}', 'AdminProductsController@getEdit');
    Route::post('products/insert', 'AdminProductsController@postInsert');
    Route::post('products/edit', 'AdminProductsController@postEdit');
});


//Route::get('exemplo', 'WelcomeControllerExemplo@exemplo');

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
