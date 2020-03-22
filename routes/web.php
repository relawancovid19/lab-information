<?php

use App\Models\SampleReceiveTaking;
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

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::middleware('auth')->group(function () {
        Route::prefix("sample_receive_taking")
            ->name("sample_receive_taking.")
            ->group(function() {
                Route::get("", "SampleReceiveTakingController@index")
                    ->name("index")
                    ->middleware("can:index," . SampleReceiveTaking::class);
                Route::get("create", "SampleReceiveTakingController@create")
                    ->name("create")
                    ->middleware("can:create," . SampleReceiveTaking::class);
                Route::post("", "SampleReceiveTakingController@store")
                    ->name("store")
                    ->middleware("can:store," . SampleReceiveTaking::class);
                Route::get("{sampleReceiveTaking}", "SampleReceiveTakingController@show")
                    ->name("show")
                    ->middleware("can:show," . SampleReceiveTaking::class);
                Route::get("{sampleReceiveTaking}/edit", "SampleReceiveTakingController@edit")
                    ->name("edit")
                    ->middleware("can:edit," . SampleReceiveTaking::class);
                Route::match(['put', 'patch'], "{sampleReceiveTaking}", "SampleReceiveTakingController@update")
                    ->name("update")
                    ->middleware("can:update," . SampleReceiveTaking::class);
            });

    });
