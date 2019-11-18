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

Route::get('/', function () {
    return view('welcome');
});

/*------Authentication's Routes----*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*------Products' Routes-----------*/
Route::resource('/products','ProductController');

Route::get('/products/{id}/confirmDelete','ProductController@confirmDelete');

/*------Companies' Routes-----------*/
Route::resource('/companies','CompanyController');

Route::get('/companies/{id}/confirmDelete','CompanyController@confirmDelete');
