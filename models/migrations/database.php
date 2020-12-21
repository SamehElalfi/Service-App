<?php

require_once('./app/config/app.php');
require_once('./app/config/database.php');

// Create the main tables
$migration_path = './app/models/migrations/';
include_once($migration_path . 'migration.php');
include_once($migration_path . 'roles.php');
include_once($migration_path . 'users.php');
include_once($migration_path . 'services.php');
include_once($migration_path . 'sells.php');


$roles = new Roles($connection);
$roles->create_table();

$users = new Users($connection);
$users->create_table();

$services = new Services($connection);
$services->create_table();

$sells = new Sells($connection);
$sells->create_table();
