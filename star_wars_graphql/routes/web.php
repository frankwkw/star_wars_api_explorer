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

// Support both GET and POST
$router->get('api/graphql', 'GraphQLController@query');
$router->post('api/graphql', 'GraphQLController@query');

// Placeholder Options support for CORS
$router->options('api/graphql', function(){});