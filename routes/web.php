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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login',"AdminController@getLogin")->name('login');
Route::get('register',"AdminController@getRegister")->name('register');

Route::group([
    'prefix'=>'/',
    'middleware'=>'checkLogin'
], function(){

    Route::get('/',"AdminController@getHome")->name('home');
    Route::get('list-product',"AdminController@getListProduct")->name('listproduct');

});


