<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$error = '';
$success = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data to edit
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'user'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // If user not found, redirect back to manage users
    if (!$user) {
        header("Location: manage_users.php");
        exit();
    }

    // Update user data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $blood_group = $_POST['blood_group'];
        $area = $_POST['area'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        // Basic validation
        if (empty($name) || empty($email) || empty($phone) || empty($blood_group) || empty($area) || empty($age) || empty($gender)) {
            $error = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } elseif (!in_array($blood_group, ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'])) {
            $error = "Invalid blood group.";
        } elseif (!in_array($gender, ['Male', 'Female'])) {
            $error = "Invalid gender.";
        } elseif ($age < 18 || $age > 120) {
            $error = "Age must be between 18 and 120.";
        } else {
            $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=?, blood_group=?, area=?, age=?, gender=? WHERE id=?");
            $stmt->bind_param("sssssssi", $name, $email, $phone, $blood_group, $area, $age, $gender, $id);
            if ($stmt->execute()) {
                $success = "User updated successfully!";
            } else {
                $error = "Failed to update user. Please try again.";
            }
            $stmt->close();
        }
    }
} else {
    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodConnect - Edit User</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-red-600">🩸BloodConnect</h1>
        <div class="flex space-x-4">
            <a href="logout.php" class="text-red-600 hover:text-red-800 font-medium bg-gray-100 px-4 py-2 rounded-lg transition duration-300">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4 flex items-center justify-center min-h-[calc(100vh-80px)]">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">
            <h2 class="text-3xl font-bold text-center text-red-600 mb-6">Edit User Information</h2>

            <!-- Success/Error Messages -->
            <?php if ($success): ?>
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg text-center">
                    <?php echo htmlspecialchars($success); ?>
                    <a href="manage_users.php" class="text-red-600 hover:text-red-800 font-medium ml-2">Back to Users</a>
                </div>
            <?php elseif ($error): ?>
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg text-center">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <!-- Edit User Form -->
            <form method="POST" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required
                           class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required
                           class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required
                           class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                </div>
                <div>
                    <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                    <select name="blood_group" id="blood_group" required
                            class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                        <option value="A+" <?php echo ($user['blood_group'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                        <option value="A-" <?php echo ($user['blood_group'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                        <option value="B+" <?php echo ($user['blood_group'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                        <option value="B-" <?php echo ($user['blood_group'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                        <option value="O+" <?php echo ($user['blood_group'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                        <option value="O-" <?php echo ($user['blood_group'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                        <option value="AB+" <?php echo ($user['blood_group'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                        <option value="AB-" <?php echo ($user['blood_group'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                    </select>
                </div>
                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700">Area</label>
                    <input type="text" name="area" id="area" value="<?php echo htmlspecialchars($user['area']); ?>" required
                           class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                </div>
                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($user['age']); ?>" required
                           class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                </div>
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender" required
                            class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                        <option value="Male" <?php echo ($user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
                <button type="submit"
                        class="w-full bg-red-600 text-white p-3 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                    Update User
                </button>
            </form>

            <!-- Back to Users Link -->
            <div class="text-center mt-4">
                <a href="manage_users.php" class="text-red-600 hover:text-red-800 font-medium">Back to Users</a>
            </div>
        </div>
    </div>
</body>
</html>