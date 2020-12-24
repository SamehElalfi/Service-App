<?php

require_once('../../config/app.php');
require_once('../../config/database.php');

// Create the main tables
include_once('migration.php');
include_once('roles.php');
include_once('users.php');
include_once('services.php');
include_once('sells.php');


$users = new Users($connection);
$stmt = $users->create_table();
print_r($stmt);
echo "Users Table Created \n";

$roles = new Roles($connection);
$stmt = $roles->create_table();
echo "Roles Table Created \n";

$services = new Services($connection);
$stmt = $services->create_table();
echo "Services Table Created \n";

$sells = new Sells($connection);
$stmt = $sells->create_table();
echo "Sells Table Created \n";
