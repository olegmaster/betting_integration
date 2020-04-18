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

Route::get('/admin', 'AdminController@summary')->name('summary');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

# Admin Panel routes

Route::get('/admin/users', 'AdminController@users')->name('ausers');



Route::get('/admin/keys', 'AdminController@keys')->name('akeys');

Route::get('/admin/transaction-history', 'AdminController@transactions')->name('atrans');

Route::get('/admin/bot-download', 'AdminController@bot');

Route::post('/admin/bot-save', 'AdminController@botSave');

Route::get('/admin/help', 'AdminController@help')->name('ahelp');

Route::get('/admin/profile', 'AdminController@profile');

Route::post('/profile-store-data', 'AdminController@profileStoreData');

Route::post('/update-admin-avatar', 'AdminController@updateAdminAvatar');

Route::post('/update-admin-password', 'AdminController@updatePassword');

Route::post('/admin-help-store', 'AdminController@helpStore');

Route::get('/admin/user-card/{id}', 'AdminController@userCard');

Route::post('/admin/update-user-profile/{id}', 'AdminController@updateUserProfile');

Route::post('/admin/update-user-password/{id}', 'AdminController@updateUserPassword');

Route::get('/admin/login-as/{id}', 'AdminController@loginAs');

Route::post('/admin/login', 'Auth\AdminLoginController@login');

Route::get('/admin/login', function () {
    return view('auth.admin-login');
});

Route::get('/admin/change-status-activate/{id}', 'AdminController@changeUserStatusActivate');
Route::get('/admin/change-status-deactivate/{id}', 'AdminController@changeUserStatusDeactivate');



Route::get('/admin/freeze-key/{id}', 'AdminController@freezeKey');

Route::get('/admin/unfreeze-key/{id}', 'AdminController@unFreezeKey');

Route::get('/admin/delete-key/{id}', 'AdminController@deleteKey');

Route::get('/admin/activate-key/{id}', 'AdminController@activateKey');

Route::get('/admin/deactivate-key/{id}', 'AdminController@deActivateKey');

Route::get('/admin/long-key/{id}', 'AdminController@longKey');

# User Cabinet routes

Route::get('/cabinet/keys', 'UserController@keys')->name('ukeys');

Route::get('/cabinet/buy-key', 'UserController@buyKey')->name('bkey');

Route::post('/cabinet/buy-key-handle', 'UserController@buyKeyHandle');

Route::get('/cabinet/download-bot', 'UserController@downloadBot');

Route::get('/cabinet/setup', 'UserController@setup')->name('usetup');

Route::post('cabinet/setup-update', 'UserController@setupUpdate');

Route::get('/cabinet/help', 'UserController@help')->name('uhelp');

Route::get('/cabinet/profile', 'UserController@profile')->name('uprofile');

Route::post('/cabinet/profile-update', 'UserController@profileUpdate');

Route::post('/cabinet/update-user-avatar', 'UserController@updateUserAvatar');

Route::post('/cabinet/update-user-password', 'UserController@updatePassword');


Route::get('/freeze-key/{id}', 'UserController@freezeKey');

Route::get('/unfreeze-key/{id}', 'UserController@unFreezeKey');

Route::get('/long-key/{id}', 'UserController@longKey');

Route::post('/user/edit-key-descr', 'UserController@editKeyDescription');

# payment callback

Route::post('/payment-handled', 'PaymentController@confirmPayment');

