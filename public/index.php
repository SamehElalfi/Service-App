<?php

/**
 * Define the main constants for app directories
 * 
 * These constants will be used across the app
 */

define('BASE_DIR', dirname(__DIR__));
define('CORE_DIR', BASE_DIR . '/core');
define('CONFIG_DIR', BASE_DIR . '/config');


define('CONTROLLERS_DIR', BASE_DIR . '/app/controllers');
define('VIEWS_DIR', BASE_DIR . '/app/views');
define('ROUTES_DIR', BASE_DIR . '/app/routes');

define('MODELS_DIR', '/app/models');
define('MIGRATION_DIR', MODELS_DIR . '/migrations');


/**
 * Include the core of the app and config files
 */
require_once(BASE_DIR . "/vendor/autoload.php");
$query = require_once(CORE_DIR . "/bootstrap.php");
