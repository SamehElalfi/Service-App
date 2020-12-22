<?php
require_once("config/app.php");
require_once("config/database.php");
require_once("config/helpers.php");

/**
 * Set the main router variable
 */
require_once("config/routes.php");
$router = new Router();
$router = $router->router();

// Main routes
switch ($router['path']) {
  case '/':
    controller('index');
    break;

  default:
    abort(404);
    break;
}
