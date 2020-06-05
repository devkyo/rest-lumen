<?php

/** @var \Laravel\Lumen\Routing\Router $router */



$router->get('/', function () use ($router) {
    return 'Welcome to the api';
});


$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->post('/users/login', ['uses' => 'UsersController@getUserByUsernameAndPassword']);
});



// Router group
$router->group(['middleware'=> ['auth'], 'prefix'=>'api/v1'], function () use ($router){

    $router->get('/users','UsersController@index');
    $router->get('/users/{id}','UsersController@getUser');
    $router->post('/users','UsersController@createUser');
    $router->put('/users/{id}','UsersController@updateUser');
    $router->delete('/users/{id}','UsersController@deleteUser');
});

