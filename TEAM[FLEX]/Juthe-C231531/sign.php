<?php
session_start();

// Database configuration
$host = 'localhost'; // Change if necessary
$db = 'arpita'; // Your database name
$user = 'root'; // Database username
$pass = ''; // Database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $age = intval($_POST['age']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $national_id = trim($_POST['national_id']);
    $address = trim($_POST['address']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate age
    if ($age < 18) {
        die("You must be at least 18 years old to sign up.");
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Validate phone number
    if (!preg_match("/^[0-9]{11}$/", $phone)) {
        die("Invalid phone number format.");
    }

    // Validate password match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM sign_up WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Email already registered.");
    }
    $stmt->close();

    // Insert new user into the database
    $stmt = $conn->prepare("INSERT INTO users (full_name, age, email, phone, national_id, address, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $full_name, $age, $email, $phone, $national_id, $address, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
