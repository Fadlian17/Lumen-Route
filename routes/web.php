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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['middleware' => 'auth.jwt'], function () use ($router) {
    $router->group(['prefix' => 'rest/api'], function () use ($router) {

        //Author
        $router->get('/author', 'AuthorController@index');
        $router->post('/author', 'AuthorController@create');
        $router->get('/author/{id}', 'AuthorController@show');
        $router->patch('/author/{id}', 'AuthorController@update');
        $router->delete('/author/{id}', 'AuthorController@destroy');
    });
});

$router->group(['middleware' => 'auth.jwt'], function () use ($router) {
    $router->group(['prefix' => 'rest/api2'], function () use ($router) {
        //Post
        $router->get('/post', 'PostController@index');
        $router->post('/post', 'PostController@create');
        $router->get('/post/{id}', 'PostController@show');
        $router->patch('/post/{id}', 'PostController@update');
        $router->delete('/post/{id}', 'PostController@destroy');
    });
});

$router->group(['middleware' => 'auth.jwt'], function () use ($router) {
    $router->group(['prefix' => 'rest/api3'], function () use ($router) {
        //Comment
        $router->get('/comment', 'CommentController@index');
        $router->post('/comment', 'CommentController@create');
        $router->get('/comment/{id}', 'CommentController@show');
        $router->patch('/comment/{id}', 'CommentController@update');
        $router->delete('/comment/{id}', 'CommentController@destroy');
    });
});
