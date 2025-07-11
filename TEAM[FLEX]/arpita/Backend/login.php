<?php
// Start session
session_start();

// Enable error reporting (for debugging, optional)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection (MySQL)
$host = "localhost";
$dbUser = "root";
$dbPass = ""; // XAMPP default
$dbName = "crypto_exchange";

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Get input
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Input validation
if (empty($email) || empty($password)) {
    echo "Please fill all fields.";
    exit;
}

// Fetch user from database
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user exists and password matches
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];

    // Redirect to dashboard
    header("Location: ../user dashboard.html"); // adjust path if needed
    exit;
} else {
    echo "Invalid email or password.";
}
?>