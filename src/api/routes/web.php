<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'contracts'], function () use ($router) {
    $router->get('/', 'ContractController@index');
    $router->get('/{id}', 'ContractController@show');
});

$router->group(['prefix' => 'events'], function () use ($router) {
    $router->get('/', 'InsuranceEventController@index');
    $router->post('/', 'InsuranceEventController@store');
    $router->get('/{id}', 'InsuranceEventController@show');
    $router->post('/{id}', 'InsuranceEventController@update');
});

$router->get('/{any:.*}', function () {
    return response()->json([
        'error' => [
            'code' => 404,
            'message' => "Not found.",
        ]
    ]);
});
