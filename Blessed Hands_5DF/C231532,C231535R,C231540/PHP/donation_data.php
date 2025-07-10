<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $cash = mysqli_real_escape_string($conn, $_POST['cash']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $select = mysqli_real_escape_string($conn, $_POST['select']);
    $loc = mysqli_real_escape_string($conn, $_POST['loc']);
    $description = mysqli_real_escape_string($conn, $_POST['textarea']);
    
    // Handle file upload
    if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create upload directory if it doesn't exist
        }

        $imageFileName = basename($_FILES["file"]["name"]);
        $target_file = $uploadDir . $imageFileName;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        
        // Check if the uploaded file type is allowed
        if (in_array($imageFileType, $allowedTypes)) {
            // Check file size (5MB limit)
            if ($_FILES["file"]["size"] <= 5000000) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    $errorMessage = "Sorry, there was an error moving your uploaded file.";
                    returnError($errorMessage);
                }
            } else {
                $errorMessage = "Sorry, your file is too large. The maximum file size allowed is 5MB.";
                returnError($errorMessage);
            }
        } else {
            $errorMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            returnError($errorMessage);
        }
    } elseif ($_FILES["file"]["error"] !== UPLOAD_ERR_NO_FILE) {
        $errorMessage = "Sorry, there was an error uploading your file: " . getFileUploadErrorMessage($_FILES["file"]["error"]);
        returnError($errorMessage);
    }
    
    // Prepare the SQL statement to insert data into the database
    $query = "INSERT INTO donations (goal_amount, title, category, country, description, image) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepare statement
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssss", $cash, $title, $select, $loc, $description, $image_path);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully!";
        header("Location: index.php"); // Redirect to another page after successful insertion
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();

/**
 * Function to return error message as response
 */
function returnError($message) {
    echo $message;
    exit();
}

/**
 * Function to return file upload error messages
 */
function getFileUploadErrorMessage($errorCode) {
    switch ($errorCode) {
        case UPLOAD_ERR_INI_SIZE:
            return "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
        case UPLOAD_ERR_FORM_SIZE:
            return "The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.";
        case UPLOAD_ERR_PARTIAL:
            return "The uploaded file was only partially uploaded.";
        case UPLOAD_ERR_NO_FILE:
            return "No file was uploaded.";
        case UPLOAD_ERR_NO_TMP_DIR:
            return "Missing a temporary folder.";
        case UPLOAD_ERR_CANT_WRITE:
            return "Failed to write file to disk.";
        case UPLOAD_ERR_EXTENSION:
            return "A PHP extension stopped the file upload.";
        default:
            return "Unknown upload error.";
    }
}
?>
