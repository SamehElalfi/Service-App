<?php

// Connect to database
$connection = new mysqli(SERVER_NAME, DB_USER, DB_PASS, DB_NAME);
if ($connection->connect_error) {
  die("Can't connect to database.");
}
