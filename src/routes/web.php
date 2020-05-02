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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::get('/', function () {
    return redirect('/contracts');
});

Route::middleware('auth')->group(function () {

    Route::prefix('contracts')->group(function () {
        Route::get('/', 'ContractController@index');
        Route::get('/new', 'ContractController@create');
        Route::get('/{id}', 'ContractController@show');
    });

    Route::prefix('events')->group(function () {
        Route::get('/{id}/new', 'InsuranceEventController@create');
    });

    Route::prefix('change-password')->group(function () {
        Route::get('/', 'Auth\AuthController@change')->name('pass-change');
        Route::post('/', 'Auth\AuthController@reset');
    });

    Route::get('/logout', 'Auth\LoginController@logout');

    Route::get('/{any}', function () {
        return abort(404);
    })->where('any', '.*');
});
