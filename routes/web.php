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

Route::group(['middleware' => ['auth']], function (\Illuminate\Routing\Router $router) {
    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Registration
    Route::resource('/registrations', 'RegistrationController')->except('destroy');

    $router->group(['middleware' => ['role:lab_officer']], function (\Illuminate\Routing\Router $router) {
        $router->prefix("sample_receive_taking")
            ->name("sample_receive_taking.")
            ->group(function () {
                Route::get("", "SampleReceiveTakingController@index")
                    ->name("index");
                Route::get("create", "SampleReceiveTakingController@create")
                    ->name("create");
                Route::post("", "SampleReceiveTakingController@store")
                    ->name("store");
                Route::get("{sampleReceiveTaking}", "SampleReceiveTakingController@show")
                    ->name("show");
                Route::get("{sampleReceiveTaking}/edit", "SampleReceiveTakingController@edit")
                    ->name("edit");
                Route::match(['put', 'patch'], "{sampleReceiveTaking}", "SampleReceiveTakingController@update")
                    ->name("update");
            });

        $router->prefix("sample_receive_pcr")
            ->name("sample_receive_pcr.")
            ->group(function () {
                Route::get("", "SampleReceivePcrController@index")
                    ->name("index");
                Route::get("create", "SampleReceivePcrController@create")
                    ->name("create");
                Route::post("", "SampleReceivePcrController@store")
                    ->name("store");
                Route::get("{sampleReceiveTaking}", "SampleReceivePcrController@show")
                    ->name("show");
                Route::get("{sampleReceiveTaking}/edit", "SampleReceivePcrController@edit")
                    ->name("edit");
                Route::match(['put', 'patch'], "{sampleReceiveTaking}", "SampleReceivePcrController@update")
                    ->name("update");
            });
    });
});
