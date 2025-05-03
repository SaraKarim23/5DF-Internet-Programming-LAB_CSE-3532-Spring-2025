<?php
include('../includes/db.php');

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone    = $_POST['phone'];
    $blood    = $_POST['blood_group'];
    $area     = $_POST['area'];
    $age      = $_POST['age'];
    $gender   = $_POST['gender'];

    // Basic server-side validation
    if (!empty($email) && !empty($name) && !empty($blood)) {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, blood_group, area, age, gender, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'user')");
        $stmt->bind_param("ssssssis", $name, $email, $password, $phone, $blood, $area, $age, $gender);
        if ($stmt->execute()) {
            $success = "Registered successfully. <a href='login.php'>Login here</a>";
        } else {
            $error = "Email already exists or error occurred.";
        }
    } else {
        $error = "Please fill all required fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #c0392b;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #c0392b;
        }
        .msg {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }
        .msg.success {
            color: green;
        }
        .msg.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>User Registration</h2>
        <?php if ($success): ?>
            <div class="msg success"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="msg error"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <input name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input name="phone" placeholder="Phone Number">
            <input name="blood_group" placeholder="Blood Group (e.g. A+, O-)" required>
            <input name="area" placeholder="Area (e.g. Chattogram)" required>
            <input type="number" name="age" placeholder="Age">
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
            </select>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
