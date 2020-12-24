<?php

// include core files
$query = new QueryBuilder(Connection::make());

// Main Request CLass
$request = new Request();

// Router Manager
$router = new Router();

// Include all routes
$routes = require_once ROUTES_DIR . '/web.php';
$router->direct($request->request['trimmed_path'], $request->request['method']);
