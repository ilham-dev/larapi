<?php

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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('/', function () use ($api) {
        return $api->app->version();
    });

    //===================================== User ========================================================//
    $api->group(['prefix' => 'user', 'middleware' => 'auth:api'], function ($api) {
        $api->get('info', 'App\Http\Controllers\v1\UserController@forUser');
        $api->get('fullinfo', 'App\Http\Controllers\v1\UserController@fullinfo');
        $api->delete('logout', 'App\Http\Controllers\v1\LoginController@logout');
    });
    //===================================== End User ====================================================//

    $api->post('register', 'App\Http\Controllers\v1\LoginController@register');
});
