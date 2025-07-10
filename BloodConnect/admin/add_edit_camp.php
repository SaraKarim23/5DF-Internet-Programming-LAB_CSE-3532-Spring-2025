<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$is_edit_mode = false;
$camp_id = null;
$camp = [
    'title' => '', 'description' => '', 'organizer' => '', 'location' => '',
    'camp_date' => '', 'start_time' => '', 'end_time' => '', 'contact_info' => ''
];

// Check if we are in edit mode
if (isset($_GET['id'])) {
    $is_edit_mode = true;
    $camp_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM camps WHERE id = ?");
    $stmt->bind_param("i", $camp_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $camp = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $organizer = $_POST['organizer'];
    $location = $_POST['location'];
    $camp_date = $_POST['camp_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $contact_info = $_POST['contact_info'];

    if ($is_edit_mode) {
        // Update existing camp
        $stmt = $conn->prepare("UPDATE camps SET title=?, description=?, organizer=?, location=?, camp_date=?, start_time=?, end_time=?, contact_info=? WHERE id=?");
        $stmt->bind_param("ssssssssi", $title, $description, $organizer, $location, $camp_date, $start_time, $end_time, $contact_info, $camp_id);
    } else {
        // Insert new camp
        $stmt = $conn->prepare("INSERT INTO camps (title, description, organizer, location, camp_date, start_time, end_time, contact_info) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $title, $description, $organizer, $location, $camp_date, $start_time, $end_time, $contact_info);
    }
    
    if ($stmt->execute()) {
        header("Location: manage_camps.php");
        exit();
    } else {
        $error = "Operation failed. Please try again.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $is_edit_mode ? 'Edit' : 'Add' ?> Camp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
        <h2 class="text-2xl font-bold text-center text-red-600 mb-6"><?= $is_edit_mode ? 'Edit' : 'Add New' ?> Donation Camp</h2>
        
        <?php if (isset($error)): ?>
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-center"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <input type="text" name="title" placeholder="Camp Title" value="<?= htmlspecialchars($camp['title']) ?>" required class="w-full p-3 border rounded-lg">
            <textarea name="description" placeholder="Camp Description" required class="w-full p-3 border rounded-lg h-32"><?= htmlspecialchars($camp['description']) ?></textarea>
            <input type="text" name="organizer" placeholder="Organizer (e.g., BloodConnect, Red Crescent)" value="<?= htmlspecialchars($camp['organizer']) ?>" required class="w-full p-3 border rounded-lg">
            <input type="text" name="location" placeholder="Location / Address" value="<?= htmlspecialchars($camp['location']) ?>" required class="w-full p-3 border rounded-lg">
            <input type="text" name="contact_info" placeholder="Contact Phone or Email" value="<?= htmlspecialchars($camp['contact_info']) ?>" class="w-full p-3 border rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="date" name="camp_date" value="<?= htmlspecialchars($camp['camp_date']) ?>" required class="w-full p-3 border rounded-lg">
                <input type="time" name="start_time" value="<?= htmlspecialchars($camp['start_time']) ?>" required class="w-full p-3 border rounded-lg">
                <input type="time" name="end_time" value="<?= htmlspecialchars($camp['end_time']) ?>" required class="w-full p-3 border rounded-lg">
            </div>
            <button type="submit" class="w-full bg-red-600 text-white p-3 rounded-lg hover:bg-red-700 transition duration-300">
                <?= $is_edit_mode ? 'Update Camp' : 'Add Camp' ?>
            </button>
            <div class="text-center">
                 <a href="manage_camps.php" class="text-gray-600 hover:text-red-800 font-medium">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>