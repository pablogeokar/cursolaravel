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

Route::get('/', 'StoreController@index');
Route::get('/category/{id?}', ['as' => 'products.category', 'uses' => 'StoreController@prodsByCategory']);

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

    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', ['as' => 'categories', 'uses' => 'AdminCategoriesController@index']);
        Route::get('create/', ['as' => 'categories.create', 'uses' => 'AdminCategoriesController@getCreate']);
        Route::get('{id?}/destroy', ['as' => 'categories.destroy', 'uses' => 'AdminCategoriesController@destroy']);
        Route::get('{id?}/edit', ['as' => 'categories.edit', 'uses' => 'AdminCategoriesController@edit']);
        Route::post('/', 'AdminCategoriesController@store');
        Route::put('{id?}/update', ['as' => 'categories.update', 'uses' => 'AdminCategoriesController@update']);
    });

    Route::group(['prefix' => 'products'], function() {

        Route::get('/', ['as' => 'products', 'uses' => 'AdminProductsController@index']);
        Route::get('create', ['as' => 'products.create', 'uses' => 'AdminProductsController@create']);
        Route::get('{id?}/destroy', ['as' => 'products.destroy', 'uses' => 'AdminProductsController@destroy']);
        Route::get('{id?}/edit', ['as' => 'products.edit', 'uses' => 'AdminProductsController@edit']);
        Route::put('{id?}/update', ['as' => 'products.update', 'uses' => 'AdminProductsController@update']);
        Route::post('/', ['as' => 'products.store', 'uses' => 'AdminProductsController@store']);
    });
    
    Route::group(['prefix' => 'images'], function() {
       
        Route::get('{id?}/product', ['as' => 'products.images', 'uses' => 'AdminProductsController@images']);
        Route::get('create/{id?}/product', ['as' => 'products.images.create', 'uses' => 'AdminProductsController@createImage']);
        Route::get('destroy/{id?}/image', ['as' => 'products.images.destroy', 'uses' => 'AdminProductsController@destroyImage']);
        Route::post('store/{id?}/product', ['as' => 'products.images.store', 'uses' => 'AdminProductsController@storeImage']);
    });
});


//Route::get('exemplo', 'WelcomeControllerExemplo@exemplo');

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
