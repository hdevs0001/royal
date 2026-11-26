<?php
// Database Connection Configuration
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "royal_rituals";

// Establish Database Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connectivity
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
