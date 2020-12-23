<?php

// include helpers 
require_once CORE_DIR . '/helpers/abort.helper.php';
require_once CORE_DIR . '/helpers/config.helper.php';
require_once CORE_DIR . '/helpers/env.helper.php';
require_once CORE_DIR . '/helpers/view.helper.php';
require_once CORE_DIR . '/helpers/controller.helper.php';

// include core files
require_once CORE_DIR . '/database/Connection.php';
require_once CORE_DIR . '/database/QueryBuilder.php';
$query = new QueryBuilder(Connection::make());

require_once CORE_DIR . '/Router.php';
require_once CORE_DIR . '/Request.php';
$router = new Router();

$routes = require_once ROUTES_DIR . '/web.php';
$request = new Request();

var_dump($request->request);
// $router->direct(Request::uri());
