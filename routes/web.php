<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\SettingsController;
use Hamcrest\Core\Set;

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

Route::group(['middleware' => 'user.status'], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/settings', SettingsController::class);
    Route::resource('/lists', ListsController::class);

    Route::post('/settings/password', [SettingsController::class, 'changePassword'])->name('change.password');

    Route::resource('/cards', CardsController::class);
});

Route::get('/access-denied', function() {
    return view('deniedaccess');
});

Route::get('/suspended', function() {
    return view('auth.suspended');
});

Route::group(['middleware' => 'admin.verify'], function() {
    Route::get('/admin', AdminController::class);
    Route::resource('/users', UserController::class);
});
