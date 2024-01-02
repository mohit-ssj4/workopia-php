<?php

if (!empty($router)) {
    $router->get('/', 'HomeController@index');
    $router->get('/listings', 'ListingsController@index');
    $router->get('/listings/create', 'ListingsController@create');
    $router->get('/listings/{id}', 'ListingsController@show');
    $router->post('/listings', 'ListingsController@store');
    $router->delete('/listings/{id}', 'ListingsController@destroy');
}
