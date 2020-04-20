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

$router->get('/', function () use ($router) {
    return 'Welcome to the api';
});




// Router group
$router->group(['middleware'=> [], 'prefix'=>'api/v1'], function () use ($router){

    $router->get('/users','UsersController@index');
    $router->get('/users/{id}','UsersController@getUser');
    $router->post('/users','UsersController@createUser');
    $router->put('/users/{id}','UsersController@updateUser');
    $router->delete('/users/{id}','UsersController@deleteUser');
});

