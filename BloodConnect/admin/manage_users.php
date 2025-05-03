<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Prepare and execute delete query safely
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_users.php"); // Refresh after deletion
    exit();
}

$result = $conn->query("SELECT * FROM users WHERE role='user'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
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
        .manage-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            width: 800px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #c0392b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #e74c3c;
            color: white;
        }
        .delete-link, .edit-link {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }
        .delete-link:hover, .edit-link:hover {
            color: #c0392b;
        }
        .button {
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #c0392b;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="manage-box">
        <h2>Manage Users</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Number</th>
                <th>Area</th>
                <th>Blood Group</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['area']) ?></td>
                    <td><?= htmlspecialchars($row['blood_group']) ?></td>
                    <td class="actions">
                        <!-- Edit link -->
                        <a href="edit_user.php?id=<?= $row['id'] ?>" class="edit-link">Edit</a>
                        
                        <!-- Delete link with confirmation -->
                        <a href="?delete=<?= $row['id'] ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <br>
        <a href="dashboard.php" class="button">Back to Dashboard</a>
    </div>
</body>
</html>
