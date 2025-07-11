<?php
session_start();
require 'connection.php'; // DB connection file

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Prepare statement
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $user, $hashed_password);
        $stmt->fetch();
        
        // Verify password
        if ($password === $hashed_password) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $user;
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
    $conn->close();
}

// Show error (if any)
if (isset($error)) {
    $_SESSION["error"] = $error;
    header("Location: ../login.php");
}
?>
