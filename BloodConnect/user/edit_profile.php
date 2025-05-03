<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];

// Fetch current user data from the database
$result = $conn->query("SELECT * FROM users WHERE id='$user_id' AND role='user'");
$row = $result->fetch_assoc();

// If no user found, redirect to dashboard
if (!$row) {
    header("Location: dashboard.php");
    exit();
}

// Update user data if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];
    $area = $_POST['area'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // Update query
    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=?, blood_group=?, area=?, age=?, gender=? WHERE id=?");
    $stmt->bind_param("sssssssi", $name, $email, $phone, $blood_group, $area, $age, $gender, $user_id);
    $stmt->execute();
    $stmt->close();

    echo "Profile updated successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .edit-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            width: 600px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #c0392b;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, select, button {
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #e74c3c;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="edit-box">
        <h2>Edit Your Profile</h2>
        <form method="POST">
            Name: <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required><br>
            Email: <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required><br>
            Phone: <input type="text" name="phone" value="<?= htmlspecialchars($row['phone']) ?>" required><br>
            Blood Group: 
            <select name="blood_group" required>
                <option value="A+" <?= ($row['blood_group'] == 'A+') ? 'selected' : '' ?>>A+</option>
                <option value="A-" <?= ($row['blood_group'] == 'A-') ? 'selected' : '' ?>>A-</option>
                <option value="B+" <?= ($row['blood_group'] == 'B+') ? 'selected' : '' ?>>B+</option>
                <option value="B-" <?= ($row['blood_group'] == 'B-') ? 'selected' : '' ?>>B-</option>
                <option value="O+" <?= ($row['blood_group'] == 'O+') ? 'selected' : '' ?>>O+</option>
                <option value="O-" <?= ($row['blood_group'] == 'O-') ? 'selected' : '' ?>>O-</option>
                <option value="AB+" <?= ($row['blood_group'] == 'AB+') ? 'selected' : '' ?>>AB+</option>
                <option value="AB-" <?= ($row['blood_group'] == 'AB-') ? 'selected' : '' ?>>AB-</option>
            </select><br>
            Area: <input type="text" name="area" value="<?= htmlspecialchars($row['area']) ?>" required><br>
            Age: <input type="number" name="age" value="<?= htmlspecialchars($row['age']) ?>" required><br>
            Gender: 
            <select name="gender" required>
                <option value="Male" <?= ($row['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= ($row['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
            </select><br>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
