<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM donations WHERE user_id = '$user_id' ORDER BY donation_date DESC");

// Eligibility Calculation
$last_donation_date = null;
$next_eligible_date = "You are eligible to donate now!";
$sql_last_date = $conn->query("SELECT donation_date FROM donations WHERE user_id = '$user_id' ORDER BY donation_date DESC LIMIT 1");
if($sql_last_date->num_rows > 0) {
    $last_donation_row = $sql_last_date->fetch_assoc();
    $last_donation_date = new DateTime($last_donation_row['donation_date']);
    $next_date = clone $last_donation_date;
    $next_date->modify('+3 months'); // Assuming a 3-month wait period

    $today = new DateTime();
    if ($today < $next_date) {
        $next_eligible_date = "You can donate again on: " . $next_date->format('d M Y');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Donation History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-red-600">🩸BloodConnect</h1>
         <div>
            <a href="dashboard.php" class="text-red-600 hover:text-red-800 font-medium bg-gray-100 px-4 py-2 rounded-lg">Dashboard</a>
            <a href="log_donation.php" class="text-red-600 hover:text-red-800 font-medium bg-gray-100 px-4 py-2 rounded-lg">Log a Donation</a>
            <a href="logout.php" class="text-red-600 hover:text-red-800 font-medium bg-gray-100 px-4 py-2 rounded-lg">Logout</a>
        </div>
    </nav>

    <div class="container mx-auto p-4">
         <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl mx-auto">
             <h2 class="text-3xl font-bold text-center text-red-600 mb-2">My Donation History</h2>
             <div class="text-center p-4 mb-6 bg-blue-100 text-blue-800 rounded-lg">
                <h3 class="font-bold text-lg"><?= $next_eligible_date ?></h3>
             </div>

             <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-red-600 text-white">
                            <th class="p-3 text-left">Donation Date</th>
                            <th class="p-3 text-left">Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b"><?= date('d M Y', strtotime($row['donation_date'])) ?></td>
                                <td class="p-3 border-b"><?= htmlspecialchars($row['location']) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="p-3 text-center border-b">You have not logged any donations yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
             <div class="text-center mt-6">
                <a href="log_donation.php" class="bg-red-600 text-white p-3 rounded-lg hover:bg-red-700">Log a New Donation</a>
            </div>
        </div>
    </div>
</body>
</html>