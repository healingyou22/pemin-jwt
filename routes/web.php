<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Validation\UnauthorizedException;

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
    return $router->app->version();
});

$router->group([
    'prefix' => 'auth',
], function () use ($router) {
    $router->post('/register', 'UserController@register');
    $router->post('/login', 'UserController@login');
    $router->get('/logout', 'UserController@logout');
    $router->get('/user', 'UserController@index');
    $router->get('/me', 'UserController@me');

    $router->get('blog', 'BlogController@index');
    $router->get('/blog/{id}', 'BlogController@blogId');
    $router->post('blog', 'BlogController@store');
    $router->put('blog/{id}', 'BlogController@update');
    $router->delete('blog/{id}', 'BlogController@destroy');
});
