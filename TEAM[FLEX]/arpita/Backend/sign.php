<?php
session_start();

// Database configuration
$host = 'localhost';
$db = 'crypto_exchange'; // Make sure this DB exists in phpMyAdmin
$user = 'root';
$pass = '';

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $full_name = trim($_POST['full_name']);
    $age = intval($_POST['age']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $national_id = trim($_POST['national_id']);
    $address = trim($_POST['address']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validations
    if ($age < 18) {
        die("❌ You must be at least 18 years old to sign up.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Invalid email format.");
    }

    if (!preg_match("/^[0-9]{11}$/", $phone)) {
        die("❌ Phone number must be 11 digits.");
    }

    if ($password !== $confirm_password) {
        die("❌ Passwords do not match.");
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("❌ Email is already registered.");
    }

    $stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (full_name, age, email, phone, national_id, address, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $full_name, $age, $email, $phone, $national_id, $address, $hashed_password);

    if ($stmt->execute()) {
        echo "✅ Registration successful! <a href='../login.html'>Login now</a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>