<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM camps WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_camps.php");
    exit();
}

$result = $conn->query("SELECT * FROM camps ORDER BY camp_date DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Donation Camps</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        .manage-box { background: white; padding: 40px; border-radius: 10px; width: 95%; margin: auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #c0392b; margin-bottom: 20px; }
        .button { display: inline-block; margin-bottom: 20px; padding: 12px 24px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .button:hover { background-color: #c0392b; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #e74c3c; color: white; }
        .actions a { color: #e74c3c; text-decoration: none; font-weight: bold; margin-right: 15px; }
        .actions a:hover { text-decoration: underline; color: #c0392b; }
    </style>
</head>
<body>
    <div class="manage-box">
        <a href="dashboard.php" style="float: right;" class="button">Back to Dashboard</a>
        <h2>Manage Donation Camps</h2>
        <a href="add_edit_camp.php" class="button">Add New Camp</a>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Organizer</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['organizer']) ?></td>
                        <td><?= date('d M Y', strtotime($row['camp_date'])) ?></td>
                        <td><?= htmlspecialchars($row['location']) ?></td>
                        <td class="actions">
                            <a href="add_edit_camp.php?id=<?= $row['id'] ?>">Edit</a>
                            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this camp?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>