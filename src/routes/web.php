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
    return redirect('/contracts');
});

Route::prefix('contracts')->group(function () {
    Route::get('/', 'ContractController@index');
    Route::get('/new', 'ContractController@create');
    Route::get('/{id}', 'ContractController@show');
});

Route::prefix('events')->group(function () {
    Route::get('/{id}/new', 'InsuranceEventController@create');
});

Auth::routes();

Route::get('/{any}', function () {
    return abort(404);
})->where('any', '.*');
