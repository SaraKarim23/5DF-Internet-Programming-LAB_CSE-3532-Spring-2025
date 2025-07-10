<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $patient_name = $_POST['patient_name'];
    $hospital = $_POST['hospital'];
    $blood_group = $_POST['blood_group'];
    $units_needed = $_POST['units_needed'];
    $urgency = $_POST['urgency'];
    $contact_number = $_POST['contact_number'];

    if (empty($patient_name) || empty($hospital) || empty($blood_group) || empty($units_needed) || empty($contact_number)) {
        $error = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO blood_requests (user_id, patient_name, hospital, blood_group, units_needed, urgency, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiss", $user_id, $patient_name, $hospital, $blood_group, $units_needed, $urgency, $contact_number);
        if ($stmt->execute()) {
            $success = "Blood request submitted successfully!";
        } else {
            $error = "Failed to submit request. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blood Request</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-red-600">🩸BloodConnect</h1>
        <div>
            <a href="dashboard.php" class="text-red-600 hover:text-red-800 font-medium bg-gray-100 px-4 py-2 rounded-lg">Dashboard</a>
            <a href="logout.php" class="text-red-600 hover:text-red-800 font-medium bg-gray-100 px-4 py-2 rounded-lg">Logout</a>
        </div>
    </nav>

    <div class="container mx-auto p-4 flex items-center justify-center min-h-[calc(100vh-80px)]">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">
            <h2 class="text-3xl font-bold text-center text-red-600 mb-6">Create a Blood Request</h2>

            <?php if ($success): ?>
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg text-center"><?= htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg text-center"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <input type="text" name="patient_name" placeholder="Patient Full Name" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                <input type="text" name="hospital" placeholder="Hospital Name & Address" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                <input type="text" name="contact_number" placeholder="Contact Number" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                <select name="blood_group" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="">Select Blood Group</option>
                    <option value="A+">A+</option> <option value="A-">A-</option> <option value="B+">B+</option> <option value="B-">B-</option>
                    <option value="O+">O+</option> <option value="O-">O-</option> <option value="AB+">AB+</option> <option value="AB-">AB-</option>
                </select>
                <input type="number" name="units_needed" placeholder="Units of Blood Needed" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                <select name="urgency" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="Normal">Normal</option>
                    <option value="Urgent">Urgent</option>
                </select>
                <button type="submit" class="w-full bg-red-600 text-white p-3 rounded-lg hover:bg-red-700">Submit Request</button>
            </form>
        </div>
    </div>
</body>
</html>