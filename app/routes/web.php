<?php

$router->get('/', 'IndexController@index');
$router->get('health-check', 'HealthCheckController');
$router->get('scheme', 'IndexController@scheme');
$router->get('regex', 'IndexController@regex');


// -----------------------------------------------------------
// Login and Registration routes
$router->get('login', 'Auth/LoginController@index');
$router->post('login', 'Auth/LoginController@create');

$router->get('register', 'Auth/register@index');
$router->post('register', 'Auth/register@create');

$router->get('logout', 'Auth/LoginController@delete');

// -----------------------------------------------------------
// Dashboard Route
$router->get('/dashboard', 'Dashboard/DashboardController@index');

// Users route
$router->get('/dashboard/users', 'Dashboard/UserController@index');
$router->get('/dashboard/users/create', 'Dashboard/UserController@create');

// Freelancer Route
$router->get('/dashboard/freelancers', 'Dashboard/FreelancerController@create');
