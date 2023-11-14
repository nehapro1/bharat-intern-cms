<?php
// Database configuration
$db_host = 'localhost'; // Replace with your database host
$db_user = 'username'; // Replace with your database username
$db_pass = 'password'; // Replace with your database password
$db_name = 'froala_cms'; // Replace with your database name

// Create a database connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
