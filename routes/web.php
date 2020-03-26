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

# Admin Panel routes

Route::get('/admin/users', 'AdminController@users')->name('home');

Route::get('/admin/users', 'AdminController@users');

Route::get('/admin/keys', 'AdminController@keys');

Route::get('/admin/transaction-history', 'AdminController@transactions');

Route::get('/admin/bot-download', 'AdminController@bot');

Route::get('/admin/help', 'AdminController@help');

Route::get('/admin/profile', 'AdminController@profile');

Route::post('/profile-store-data', 'AdminController@profileStoreData');

Route::post('/update-admin-avatar', 'AdminController@updateAdminAvatar');

Route::post('/update-admin-password', 'AdminController@updatePassword');

Route::post('/admin-help-store', 'AdminController@helpStore');

Route::get('/admin/user-card/{id}', 'AdminController@userCard');

Route::post('/admin/update-user-profile/{id}', 'AdminController@updateUserProfile');

Route::post('/admin/update-user-password/{id}', 'AdminController@updateUserPassword');

Route::get('/admin/login-as/{id}', 'AdminController@loginAs');

# User Cabinet routes

Route::get('/cabinet/keys', 'UserController@keys');

Route::get('/cabinet/buy-key', 'UserController@buyKey');

Route::get('/cabinet/download-bot', 'UserController@downloadBot');

Route::get('/cabinet/setup', 'UserController@setup');

Route::get('/cabinet/help', 'UserController@help');

Route::get('/cabinet/profile', 'UserController@profile');

Route::post('/cabinet/profile-update', 'UserController@profileUpdate');

Route::post('/cabinet/update-user-avatar', 'UserController@updateUserAvatar');

Route::post('/cabinet/update-user-password', 'UserController@updatePassword');
