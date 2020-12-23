<?php

use App\Core\Router as Router;

/**
 * Set the main router variable
 */
$router = new Router();

// $router->get('/', "index");
$router->get('/', 'index@index');
$router->get('/new', 'index@new');

return $router;
