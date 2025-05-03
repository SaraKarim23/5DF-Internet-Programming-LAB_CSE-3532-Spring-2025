<?php
include('../includes/db.php');
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'user'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['area'] = $row['area'];
            $_SESSION['blood_group'] = $row['blood_group'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodConnect - User Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <!-- Logo and Title -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-red-600">BloodConnect</h1>
            <h2 class="text-xl font-semibold text-gray-700 mt-2">User Login</h2>
        </div>

        <!-- Login Form -->
        <form method="post" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required
                       class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required
                       class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
            </div>
            <button type="submit"
                    class="w-full bg-red-600 text-white p-3 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                Login
            </button>
        </form>

        <!-- Error Message -->
        <?php if ($error): ?>
            <div class="mt-4 text-center text-red-600 text-sm"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Register Link -->
        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">
                Not registered? <a href="register.php" class="text-red-600 hover:text-red-800 font-medium">Create an account</a>
            </p>
        </div>
    </div>
</body>
</html>