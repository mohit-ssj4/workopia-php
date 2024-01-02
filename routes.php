<?php

if (!empty($router)) {
    // GET requests
    $router->get('/', 'HomeController@index');
    $router->get('/listings', 'ListingsController@index');
    $router->get('/listings/create', 'ListingsController@create');
    $router->get('/listings/edit/{id}', 'ListingsController@edit');
    $router->get('/listings/{id}', 'ListingsController@show');

    // POST requests
    $router->post('/listings', 'ListingsController@store');

    // PUT requests
    $router->put('/listings/{id}', 'ListingsController@update');

    // DELETE requests
    $router->delete('/listings/{id}', 'ListingsController@destroy');
}
