<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "incipient";
$port = 3306;

// Connect to MySQL server (without specifying a database)
$conn = new mysqli($servername, $username, $password, "", $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS `$db_name`";
if (!$conn->query($sql)) {
    die("Database creation failed: " . $conn->error);
}

// Select the database
$conn->select_db($db_name);
?>
