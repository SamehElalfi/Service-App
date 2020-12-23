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

// Main Request CLass
require_once CORE_DIR . '/Request.php';
$request = new Request();

// Router Manager
require_once CORE_DIR . '/Router.php';
$router = new Router();

// Include all routes
$routes = require_once ROUTES_DIR . '/web.php';
// var_dump($request->request['path']);
$router->direct($request->request['trimmed_path'], $request->request['method']);
// $router->direct(Request::uri());
