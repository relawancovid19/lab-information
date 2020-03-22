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

Route::redirect('/', '/login', 301);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Registration
    Route::resource('/registrations', 'RegistrationController')->except('destroy');
});