<?php
include('../includes/db.php');
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle status change or deletion
if (isset($_GET['action'])) {
    $id = $_GET['id'];
    if ($_GET['action'] == 'delete') {
        $stmt = $conn->prepare("DELETE FROM blood_requests WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } else {
        $status = $_GET['action']; // e.g., 'Fulfilled' or 'Active'
        $stmt = $conn->prepare("UPDATE blood_requests SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }
    header("Location: manage_requests.php");
    exit();
}

$result = $conn->query("SELECT br.*, u.name as requester_name FROM blood_requests br JOIN users u ON br.user_id = u.id ORDER BY br.request_date DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Blood Requests</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .manage-box { background: white; padding: 40px; border-radius: 10px; width: 90%; max-width: 1200px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #c0392b; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #e74c3c; color: white; }
        .actions a { color: #e74c3c; text-decoration: none; font-weight: bold; margin-right: 10px; }
        .actions a:hover { color: #c0392b; }
        .button { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 5px; }
        .button:hover { background-color: #c0392b; }
    </style>
</head>
<body>
    <div class="manage-box">
        <h2>Manage Blood Requests</h2>
        <table>
            <tr>
                <th>Patient</th><th>Blood Group</th><th>Hospital</th><th>Urgency</th><th>Status</th><th>Contact</th><th>Requester</th><th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['patient_name']) ?></td>
                    <td><?= htmlspecialchars($row['blood_group']) ?></td>
                    <td><?= htmlspecialchars($row['hospital']) ?></td>
                    <td><?= htmlspecialchars($row['urgency']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['contact_number']) ?></td>
                    <td><?= htmlspecialchars($row['requester_name']) ?></td>
                    <td class="actions">
                        <?php if ($row['status'] == 'Active'): ?>
                            <a href="?action=Fulfilled&id=<?= $row['id'] ?>">Mark Fulfilled</a>
                        <?php else: ?>
                             <a href="?action=Active&id=<?= $row['id'] ?>">Mark Active</a>
                        <?php endif; ?>
                        <a href="?action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <br>
        <a href="dashboard.php" class="button">Back to Dashboard</a>
    </div>
</body>
</html>