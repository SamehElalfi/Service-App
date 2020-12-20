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


switch ($router['path']) {
  case '/home':
    controller('users');
    break;

  default:
    abort(404);
    break;
}
