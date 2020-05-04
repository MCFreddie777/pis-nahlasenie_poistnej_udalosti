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

// Auth routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Redirect user to the list of contracts, employee to the events to be reviewed
Route::get('/', function () {
    if (is_null(Auth::user()))
        return redirect('/login');
    else
        return Auth::user()->hasRole('employee') ? redirect('/review-events') : redirect('/contracts');
});

Route::middleware('auth')->group(function () {
    Route::prefix('contracts')->group(function () {
        Route::get('/', 'ContractController@index');
        Route::get('/new', 'ContractController@create');
        Route::get('/{id}', 'ContractController@show');
    });

    Route::prefix('events')->group(function () {
        Route::get('/', 'InsuranceEventController@index');
        Route::get('/new', 'InsuranceEventController@create');
        Route::post('/', 'InsuranceEventController@store');
        Route::get('/{id}', 'InsuranceEventController@show');
    });

    Route::prefix('review-events')->group(function () {
        Route::get('/', 'EmployeeActionsController@indexEvents');
        Route::get('/{id}', 'EmployeeActionsController@showEvent');
        Route::post('/{id}', 'EmployeeActionsController@handleReview');
    });

    Route::prefix('change-password')->group(function () {
        Route::get('/', 'Auth\AuthController@change')->name('pass-change');
        Route::post('/', 'Auth\AuthController@reset');
    });

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/{any}', function () {
        return abort(404);
    })->where('any', '.*');
});
