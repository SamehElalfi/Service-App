<?php

// include helpers 
require_once CORE_DIR . '/helpers/abort.helper.php';
require_once CORE_DIR . '/helpers/config.helper.php';
require_once CORE_DIR . '/helpers/env.helper.php';
require_once CORE_DIR . '/helpers/view.helper.php';
require_once CORE_DIR . '/helpers/controller.helper.php';

// include core files
$query = new QueryBuilder(Connection::make());

// Main Request CLass
$request = new Request();

// Router Manager
$router = new Router();

// Include all routes
$routes = require_once ROUTES_DIR . '/web.php';
$router->direct($request->request['trimmed_path'], $request->request['method']);
