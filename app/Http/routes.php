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
    return redirect('admin/categories');
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

Route::group(['prefix' => 'admin'], function () {
    Route::get('categories/', 'AdminCategoriesController@index');
    Route::get('categories/insert/', 'AdminCategoriesController@getInsert');
    Route::get('categories/delete/{id?}', 'AdminCategoriesController@getDelete');
    Route::get('categories/edit/{id?}', 'AdminCategoriesController@getEdit');
    Route::post('categoriesa/insert', 'AdminCategoriesController@postInsert');
    Route::post('categories/edit', 'AdminCategoriesController@postEdit');

    Route::get('products/', 'AdminProductsController@index');
    Route::get('products/insert', 'AdminProductsController@getInsert');
    Route::get('products/delete/{id?}', 'AdminProductsController@getDelete');
    Route::get('products/edit/{id?}', 'AdminProductsController@getEdit');
    Route::post('products/insert', 'AdminProductsController@postInsert');
    Route::post('products/edit', 'AdminProductsController@postEdit');
});


Route::get('exemplo', 'WelcomeControllerExemplo@exemplo');
