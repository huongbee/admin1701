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
Route::post('login',"AdminController@postLogin")->name('login');

Route::get('register',"AdminController@getRegister")->name('register');
Route::post('register',"AdminController@postRegister")->name('register');

Route::group([
    'prefix'=>'/',
    'middleware'=>'checkLogin'
], function(){

    Route::get('/',"AdminController@getHome")->name('home');
    Route::get('update-status-bill',"AdminController@getUpdateStatusBill")->name('update-status-bill');

    Route::get('{alias}',"AdminController@getListProductByType")->name('listproduct');

    Route::get('edit/{alias}-{id}',"AdminController@getEditProductByType")->name('editproduct')->where([
        'alias'=>'[a-zA-Z0-9-,]+',
        'id'=>'[0-9]+'
    ]);


    Route::get('logout','AdminController@logout')->name('logout');    
});

