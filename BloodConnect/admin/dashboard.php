<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .dashboard-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #c0392b;
        }
        a {
            display: block;
            width: 100%;
            text-align: center;
            background: #e74c3c;
            color: white;
            padding: 12px;
            margin: 12px 0;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s;
        }
        a:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="dashboard-box">
        <h2>Welcome, Admin</h2>
        <a href="manage_users.php">Manage Users</a>
        <a href="../logout.php">Logout</a>
    </div>
</body>
</html>
