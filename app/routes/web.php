<?php

$router->get('', 'index@index');
$router->get('health-check', 'healthCheck');
$router->get('scheme', 'index@scheme');
$router->get('regex', 'index@regex');
$router->get('users/{id}/profile/{name}/edit', 'index@home');
