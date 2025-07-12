<?php
    session_start();
    
    require 'connection.php'; // DB connection file

    // Check if form submitted via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get and sanitize inputs
        $user = trim($_POST['username'] ?? '');
        $email = $_POST['email'] ?? '';
        $pass = trim($_POST['password'] ?? '');
        $confirm_pass = trim($_POST['confirm_password'] ?? '');

        if (empty($user) || empty($email) || empty($pass) || empty($confirm_pass)) {
            $_SESSION['error'] = "All fields are required.";
            header("Location: ../register.php");
            exit();
        }

        if ($pass !== $confirm_pass) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: ../register.php");
            exit();
        }

        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $user, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $_SESSION['error'] = "Username Or Email already taken.";
            $stmt->close();
            header("Location: ../register.php");
            exit();
        }
        $stmt->close();

        // Insert user
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $email, $pass);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful. You can now log in.";
            header("Location: ../login.php");
            exit();
        } else {
            $_SESSION['error'] = "Registration failed. Please try again.";
            header("Location: ../register.php");
            exit();
        }
        $stmt->close();
    }

    $conn->close();
?>
