<?php
// Database connection parameters
$servername = "localhost"; // Assuming your database is hosted locally
$username = "root"; // Replace with your database username
$password = ""; // Assuming your password is empty
$database = "travaldb"; // Replace with your database name

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
