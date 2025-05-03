<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");

// Default values for search filters
$area = isset($_POST['area']) ? $_POST['area'] : '';
$blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : '';

// Build the SQL query based on user input (both filters)
$query = "SELECT * FROM users WHERE role='user'";

// If area is specified, filter by area
if ($area) {
    $query .= " AND area='$area'";
}

// If blood group is specified, filter by blood group
if ($blood_group) {
    $query .= " AND blood_group='$blood_group'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-red-600">🩸BloodConnect</h1>
    <div class="flex space-x-4">
        <a href="edit_profile.php" class="text-red-600 hover:text-red-800 font-medium bg-gray-100 px-4 py-2 rounded-lg transition duration-300">Profile</a>
        <a href="logout.php" class="text-red-600 hover:text-red-800 font-medium bg-gray-100 px-4 py-2 rounded-lg transition duration-300">Logout</a>
    </div>
</nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4 flex items-center justify-center min-h-[calc(100vh-80px)]">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl">
            <h2 class="text-3xl font-bold text-center text-red-600 mb-6">Search Users</h2>

            <!-- Search Filters -->
            <form method="POST" class="mb-6">
                <div class="flex flex-col sm:flex-row gap-4">
                    <select name="area" class="w-full sm:w-1/2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">Select Area</option>
                        <?php
                        $areaResult = $conn->query("SELECT DISTINCT area FROM users");
                        while ($row = $areaResult->fetch_assoc()) {
                            echo "<option value='" . $row['area'] . "'" . ($area == $row['area'] ? ' selected' : '') . ">" . $row['area'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="blood_group" class="w-full sm:w-1/2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">Select Blood Group</option>
                        <option value="A+" <?php echo ($blood_group == 'A+') ? 'selected' : ''; ?>>A+</option>
                        <option value="A-" <?php echo ($blood_group == 'A-') ? 'selected' : ''; ?>>A-</option>
                        <option value="B+" <?php echo ($blood_group == 'B+') ? 'selected' : ''; ?>>B+</option>
                        <option value="B-" <?php echo ($blood_group == 'B-') ? 'selected' : ''; ?>>B-</option>
                        <option value="O+" <?php echo ($blood_group == 'O+') ? 'selected' : ''; ?>>O+</option>
                        <option value="O-" <?php echo ($blood_group == 'O-') ? 'selected' : ''; ?>>O-</option>
                        <option value="AB+" <?php echo ($blood_group == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                        <option value="AB-" <?php echo ($blood_group == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                    </select>
                    <button type="submit" class="w-full sm:w-auto bg-red-600 text-white p-3 rounded-lg hover:bg-red-700 transition duration-300">Search</button>
                </div>
            </form>

            <!-- Display Search Results -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-red-600 text-white">
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Blood Group</th>
                            <th class="p-3 text-left">Area</th>
                            <th class="p-3 text-left">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="p-3 border-b"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="p-3 border-b"><?php echo htmlspecialchars($row['blood_group']); ?></td>
                                <td class="p-3 border-b"><?php echo htmlspecialchars($row['area']); ?></td>
                                <td class="p-3 border-b"><?php echo htmlspecialchars($row['phone']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Clear Filters Button -->
            <div class="text-center mt-4">
                <a href="dashboard.php" class="text-red-600 hover:text-red-800 font-medium">Clear Filters</a>
            </div>
        </div>
    </div>
</body>
</html>