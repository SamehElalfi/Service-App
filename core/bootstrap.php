<?php

// include helpers 
require_once CORE_DIR . '/helpers/abort.helper.php';
require_once CORE_DIR . '/helpers/config.helper.php';
require_once CORE_DIR . '/helpers/env.helper.php';
require_once CORE_DIR . '/helpers/view.helper.php';
require_once CORE_DIR . '/helpers/controller.helper.php';

// include core files
require_once 'database/Connection.php';
require_once 'database/QueryBuilder.php';

return new QueryBuilder(Connection::make());


// $router = require_once("../routes/web.php");
// $request = new \App\Core\Request();

// echo $router[$request->uri];
// echo "hello test";
