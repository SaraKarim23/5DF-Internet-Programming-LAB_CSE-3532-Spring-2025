<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Fetch active blood requests
$result = $conn->query("SELECT br.*, u.name AS requester_name FROM blood_requests br JOIN users u ON br.user_id = u.id WHERE br.status = 'Active' ORDER BY br.urgency DESC, br.request_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Active Blood Requests</title>
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

    <div class="container mx-auto p-4">
         <h2 class="text-3xl font-bold text-center text-red-600 my-6">Active Blood Requests</h2>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 <?= $row['urgency'] == 'Urgent' ? 'border-red-500' : 'border-blue-500' ?>">
                        <?php if ($row['urgency'] == 'Urgent'): ?>
                            <span class="text-xs font-bold inline-block py-1 px-2 uppercase rounded-full text-red-600 bg-red-200 last:mr-0 mr-1">
                                URGENT
                            </span>
                        <?php endif; ?>
                        <h3 class="text-2xl font-bold mt-2"><?= htmlspecialchars($row['patient_name']) ?></h3>
                        <p class="text-gray-700">Needs <span class="font-bold text-red-600"><?= htmlspecialchars($row['blood_group']) ?></span> blood (<?= htmlspecialchars($row['units_needed']) ?> units)</p>
                        <p class="text-gray-600 mt-2">At: <span class="font-semibold"><?= htmlspecialchars($row['hospital']) ?></span></p>
                        <p class="text-gray-600">Contact: <span class="font-semibold"><?= htmlspecialchars($row['contact_number']) ?></span></p>
                        <p class="text-sm text-gray-500 mt-4">Posted by: <?= htmlspecialchars($row['requester_name']) ?> on <?= date('d M Y', strtotime($row['request_date'])) ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center col-span-full">No active blood requests at the moment.</p>
            <?php endif; ?>
         </div>
    </div>
</body>
</html>