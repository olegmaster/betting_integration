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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', 'AdminController@summary');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/users', 'AdminController@users')->name('home');

Route::get('/admin/users', 'AdminController@users');

Route::get('/admin/keys', 'AdminController@keys');

Route::get('/admin/transaction-history', 'AdminController@transactions');

Route::get('/admin/bot', 'AdminController@bot');

Route::get('/admin/help', 'AdminController@help');

