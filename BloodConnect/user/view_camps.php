<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch upcoming camps (from today onwards)
$today = date("Y-m-d");
$result = $conn->query("SELECT * FROM camps WHERE camp_date >= '$today' ORDER BY camp_date ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upcoming Donation Camps</title>
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
         <h2 class="text-3xl font-bold text-center text-red-600 my-6">Upcoming Donation Camps</h2>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-red-500 flex flex-col justify-between">
                        <div>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($row['organizer']) ?></p>
                            <h3 class="text-2xl font-bold mt-1"><?= htmlspecialchars($row['title']) ?></h3>
                            <p class="text-gray-700 mt-2"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                            
                            <div class="mt-4 space-y-2">
                                <p class="text-gray-800"><span class="font-bold">📍 Location:</span> <?= htmlspecialchars($row['location']) ?></p>
                                <p class="text-gray-800"><span class="font-bold">📅 Date:</span> <?= date('l, d F Y', strtotime($row['camp_date'])) ?></p>
                                <p class="text-gray-800"><span class="font-bold">⏰ Time:</span> <?= date('h:i A', strtotime($row['start_time'])) ?> to <?= date('h:i A', strtotime($row['end_time'])) ?></p>
                                <?php if(!empty($row['contact_info'])): ?>
                                <p class="text-gray-800"><span class="font-bold">📞 Contact:</span> <?= htmlspecialchars($row['contact_info']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center col-span-full text-gray-600 text-xl mt-10">No upcoming donation camps are scheduled at the moment. Please check back later.</p>
            <?php endif; ?>
         </div>
    </div>
</body>
</html>