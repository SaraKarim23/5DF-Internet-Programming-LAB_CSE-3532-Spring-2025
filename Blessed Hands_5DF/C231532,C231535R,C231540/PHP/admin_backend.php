<?php
// Include the database connection file
include("connection.php");

// Insert operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add') {
        // Add a new campaign
        $campaignTitle = $_POST['campaignTitle'];
        $campaignImage = $_POST['campaignImage'];
        $campaignGoal = $_POST['campaignGoal'];

        $sql = "INSERT INTO campaign (campaignTitle, image, goal_amount) 
                VALUES ('$campaignTitle', '$campaignImage', '$campaignGoal')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Campaign added successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif ($action === 'update') {
        // Update an existing campaign
        $id = $_POST['id'];
        $campaignTitle = $_POST['campaignTitle'];
        $campaignImage = $_POST['campaignImage'];
        $campaignGoal = $_POST['campaignGoal'];

        $sql = "UPDATE campaign 
                SET campaignTitle = '$campaignTitle', image = '$campaignImage', goal_amount = '$campaignGoal'
                WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Campaign updated successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM campaign WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Campaign deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch all campaigns to display
$sql = "SELECT * FROM campaign";
$result = $conn->query($sql);
$campaigns = [];
if ($result->num_rows > 0) {

    
    while ($row = $result->fetch_assoc()) {
        $campaigns[] = $row;
    }
}

$conn->close();
?>
