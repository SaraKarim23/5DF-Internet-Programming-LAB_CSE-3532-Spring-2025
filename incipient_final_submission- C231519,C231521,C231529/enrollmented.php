<?php
session_start();
require 'dbfile/connection.php';

$userId = $_SESSION['user_id'] ?? null;

// Fetch enrollments with course details
$sql = "
  SELECT 
    e.id AS enrollment_id,
    e.status,
    e.enrolled_at,
    e.payment_amount,
    c.coursename,
    c.duration,
    c.level,
    c.price,
    c.image
  FROM 
    enrollments e
  INNER JOIN 
    courses c ON e.course_id = c.id
";

if ($userId) {
    $sql .= " WHERE e.user_id = $userId";
}

$sql .= " ORDER BY e.enrolled_at DESC";

$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Enrollments - INCIPIENT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #000; color: #fff; font-family: 'Roboto', sans-serif; }
    .enrollment-card { background: #1c1c1c; border-radius: 12px; padding: 20px; box-shadow: 0 0 8px rgba(255,255,255,0.1); }
    .enrollment-card img { max-height: 180px; object-fit: cover; }
  </style>
</head>
<body>

<?php include 'layout/nav.php'; ?>

<div class="container my-5">
  <h3 class="text-center text-info mb-5">📘 My Enrolled Courses</h3>
  <div class="row g-4">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="enrollment-card text-center">
            <img src="<?= htmlspecialchars($row['image']) ?>" class="img-fluid mb-3" alt="<?= htmlspecialchars($row['coursename']) ?>">
            <h4><?= htmlspecialchars($row['coursename']) ?></h4>
            <div class="text-info">Duration: <?= htmlspecialchars($row['duration']) ?> | Level: <?= htmlspecialchars($row['level']) ?></div>
            
            <p>Status: <span class="badge bg-info text-dark"><?= $row['status'] ?></span></p>
            <p>Payment: ৳<?= number_format($row['payment_amount'], 2) ?></p>
            <p>Enrolled At: <?= date("F j, Y, g:i a", strtotime($row['enrolled_at'])) ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-white text-center">No enrollments found.</p>
    <?php endif; ?>
  </div>
</div>

<footer class="bg-dark text-center py-3">
  <p>&copy; 2025 Incipient. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
