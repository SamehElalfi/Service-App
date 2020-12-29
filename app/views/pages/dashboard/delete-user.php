<?php
require_once('functions.php');

// Return if no ID
if (!isset($_GET['id'])) header("Location: dashboard.php");

// Delete User with ID
$user_id = $_GET['id'];
$query = "DELETE FROM users where id = `$user_id`";
$result = mysqli_query($connection, $query);

if ($result) {
    header("Location: dashboard.php");
} else {
    echo "Can't find the user with the ID '$user_id'";
}