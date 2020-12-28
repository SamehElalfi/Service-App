<?php

$router->get('/', 'index@index');
$router->get('health-check', 'healthCheck');
$router->get('scheme', 'index@scheme');
$router->get('regex', 'index@regex');
$router->get('users/{id}/profile/{name}/edit', 'index@home');


// Login and Registration routes
$router->get('login', 'Auth/login@index');
$router->post('login', 'Auth/login@create');

$router->get('register', 'Auth/register@index');
$router->post('register', 'Auth/register@create');

$router->get('logout', 'Auth/login@delete');
