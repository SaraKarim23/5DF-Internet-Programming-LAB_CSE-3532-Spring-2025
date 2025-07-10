<?php
$servername = "localhost"; // Replace with your database server, e.g., '127.0.0.1' or 'localhost'
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "blessed_hands"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
