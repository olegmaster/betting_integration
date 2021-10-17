<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BotController;
use App\Http\Controllers\Admin\HelpController;
use App\Http\Controllers\Admin\KeyController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SummaryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserCardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;

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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->group(function () {

    Route::post('login', [AdminLoginController::class, 'login']);

    Route::get('login', function () {
        return view('auth.admin-login');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [SummaryController::class, 'summary'])->name('summary');

        Route::get('transaction-history', [TransactionController::class, 'transactions'])->name('atrans');

        Route::get('bot-download', [BotController::class, 'bot']);
        Route::post('bot-save', [BotController::class, 'botSave']);

        Route::get('help', [HelpController::class, 'help'])->name('ahelp');
        Route::post('/admin-help-store', [HelpController::class, 'helpStore']);

        Route::get('user-card/{id}', [UserCardController::class, 'userCard']);

        Route::post('update-user-profile/{id}', [ProfileController::class, 'updateUserProfile']);
        Route::get('profile', [ProfileController::class, 'profile']);

        Route::get('login-as/{id}', [AdminController::class, 'loginAs']);
        Route::post('/update-admin-avatar', [AdminController::class, 'updateAdminAvatar']);



        Route::get('users', [UserController::class, 'users'])->name('ausers');
        Route::get('change-status-activate/{id}', [UserController::class, 'changeUserStatusActivate']);
        Route::get('change-status-deactivate/{id}', [UserController::class, 'changeUserStatusDeactivate']);
        Route::post('update-user-password/{id}', [UserController::class, 'updateUserPassword']);
        Route::post('/update-admin-password', [UserController::class, 'updatePassword']);

        Route::get('keys', [KeyController::class, 'keys'])->name('akeys');
        Route::get('freeze-key/{id}', [KeyController::class, 'freezeKey']);
        Route::get('unfreeze-key/{id}', [KeyController::class, 'unFreezeKey']);
        Route::get('delete-key/{id}', [KeyController::class, 'deleteKey']);
        Route::get('activate-key/{id}', [KeyController::class, 'activateKey']);
        Route::get('deactivate-key/{id}', [KeyController::class, 'deActivateKey']);
        Route::get('long-key/{id}', [KeyController::class, 'longKey']);
    });
});


Route::namespace('Cabinet')->prefix('cabinet')->group(function () {
    Route::middleware(['auth', 'active'])->group(function () {
        Route::get('keys', 'UserController@keys')->name('ukeys');
        Route::get('buy-key', 'UserController@buyKey')->name('bkey');
        Route::post('buy-key-handle', 'UserController@buyKeyHandle');
        Route::get('download-bot', 'UserController@downloadBot');
        Route::get('setup', 'UserController@setup')->name('usetup');
        Route::post('setup-update', 'UserController@setupUpdate');
        Route::get('help', 'UserController@help')->name('uhelp');
        Route::get('profile', 'UserController@profile')->name('uprofile');
        Route::post('profile-update', 'UserController@profileUpdate');
        Route::post('update-user-avatar', 'UserController@updateUserAvatar');
        Route::post('update-user-password', 'UserController@updatePassword');
    });
});


Route::get('/freeze-key/{id}', 'UserController@freezeKey');

Route::get('/unfreeze-key/{id}', 'UserController@unFreezeKey');

Route::get('/long-key/{id}', 'UserController@longKey');

Route::post('/user/edit-key-descr', 'UserController@editKeyDescription');

# payment callback

Route::post('/payment-handled', 'PaymentController@confirmPayment');

