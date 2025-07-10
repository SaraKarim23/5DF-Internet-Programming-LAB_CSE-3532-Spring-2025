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
    $donation_date = $_POST['donation_date'];
    $location = $_POST['location'];

    if (empty($donation_date)) {
        $error = "Donation date is required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO donations (user_id, donation_date, location) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $donation_date, $location);
        if ($stmt->execute()) {
            $success = "Donation logged successfully!";
        } else {
            $error = "Failed to log donation.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log a Donation</title>
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
            <h2 class="text-3xl font-bold text-center text-red-600 mb-6">Log Your Donation</h2>
             <?php if ($success): ?>
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg text-center"><?= htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg text-center"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST" class="space-y-4">
                <div>
                    <label for="donation_date" class="block text-sm font-medium text-gray-700">Donation Date</label>
                    <input type="date" name="donation_date" id="donation_date" required class="w-full p-3 mt-1 border rounded-lg">
                </div>
                 <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location (Hospital/Camp)</label>
                    <input type="text" name="location" id="location" placeholder="e.g., City General Hospital" class="w-full p-3 mt-1 border rounded-lg">
                </div>
                <button type="submit" class="w-full bg-red-600 text-white p-3 rounded-lg hover:bg-red-700">Log Donation</button>
            </form>
             <div class="text-center mt-4">
                <a href="donation_history.php" class="text-red-600 hover:text-red-800 font-medium">View My Donation History</a>
            </div>
        </div>
    </div>
</body>
</html>