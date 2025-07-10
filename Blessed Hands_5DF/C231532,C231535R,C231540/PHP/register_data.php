<?php
session_start(); // Start a session to store messages
include 'connection.php';

// Check if the connection is established
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? ''; // Plain-text password

    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['message'] = "Error: Name, email, or password is missing.";
        $_SESSION['message_type'] = "error";
        header("Location: form.php"); // Redirect back to the form page
        exit;
    }

    // Prepare an SQL statement
    $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        $_SESSION['message'] = "Error preparing statement: " . $conn->error;
        $_SESSION['message_type'] = "error";
        header("Location: form.php");
        exit;
    }

    // Bind the parameters
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Data inserted successfully!";
        $_SESSION['message_type'] = "success";
        header("Location: index.php"); // Redirect to the desired page
        // Close the statement
        $stmt->close();
        // Close the connection
        mysqli_close($conn);
        exit;
    } else {
        $_SESSION['message'] = "Error inserting data: " . $stmt->error;
        $_SESSION['message_type'] = "error";
        // Close the statement
        $stmt->close();
        // Close the connection
        mysqli_close($conn);
        header("Location: form.php");
        exit;
    }
} else {
    $_SESSION['message'] = "No POST data received.";
    $_SESSION['message_type'] = "error";
    // Close the connection
    mysqli_close($conn);
    header("Location: form.php");
    exit;
}
?>
