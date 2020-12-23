<?php

/**
 * Define the main constants for app directories
 * 
 * These constants will be used across the app
 */

define('BASE_DIR', dirname(__DIR__));
define('CORE_DIR', BASE_DIR . '/core');

define('CONFIG_DIR', BASE_DIR . '/config');

define('CONTROLLERS_DIR', BASE_DIR . '/controllers');
define('VIEWS_DIR', BASE_DIR . '/views');
define('ROUTES_DIR', BASE_DIR . '/routes');

define('DATABASE_DIR', BASE_DIR . '/database');
define('MIGRATION_DIR', DATABASE_DIR . '/migrations');
define('MODELS_DIR', DATABASE_DIR . '/models');


/**
 * Include the core of the app and config files
 */
require_once(BASE_DIR . "/vendor/autoload.php");
$query = require_once(CORE_DIR . "/bootstrap.php");
