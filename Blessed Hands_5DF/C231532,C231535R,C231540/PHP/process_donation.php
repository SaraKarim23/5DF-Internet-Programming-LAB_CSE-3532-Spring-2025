<?php
include("connection.php");

// Process the donation form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $amount = (float)$_POST['amount']; // Ensure amount is treated as a number
    $message = isset($_POST['message']) ? $conn->real_escape_string($_POST['message']) : null;

    // Insert the donation record into the database
    $sql = "INSERT INTO child_food_donations (name, email, amount, message, donation_date) 
            VALUES ('$name', '$email', $amount, '$message', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a thank-you page or display a success message
        echo "<div style='text-align: center; margin-top: 50px;'>
                <h1>Thank You for Your Donation!</h1>
                <p>Your generosity makes a difference.</p>
                <a href='profile.php' style='display: inline-block; margin-top: 20px; background-color: #53E4DA; color: white; padding: 10px 20px; border-radius: 25px; text-decoration: none;'>Back to Home Page</a>
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
