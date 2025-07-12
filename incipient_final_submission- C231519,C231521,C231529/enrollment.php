<?php
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $error = $_SESSION['error'] ?? '';
    unset($_SESSION['error']);

    $success = $_SESSION['success'] ?? '';
    unset($_SESSION['success']);
    
    $username = htmlspecialchars($_SESSION['username']);

    require 'dbfile/connection.php';

    // Validate course ID
    $courseId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($courseId <= 0) {
        die("Invalid course ID.");
    }

    // Fetch course info
    $sql = "SELECT * FROM courses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $courseId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Course not found.");
    }

    $course = $result->fetch_assoc();
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Enroll in <?php echo htmlspecialchars($course['coursename']); ?> | INCIPIENT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      color: #fff;
    }
    .enroll-container {
      max-width: 600px;
      margin: 80px auto;
      padding: 30px;
      background-color: #1a1a1a;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(255,255,255,0.1);
    }
  </style>
</head>
<body>
    
  <?php include 'layout/nav.php'; ?>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center" role="alert">
      <?= htmlspecialchars($error) ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success text-center" role="alert">
      <?= htmlspecialchars($success) ?>
    </div>
  <?php endif; ?>

  <div class="container enroll-container text-center">
    <img src="<?php echo htmlspecialchars($course['image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($course['coursename']); ?>">
    <h2>Enroll in <?php echo htmlspecialchars($course['coursename']); ?></h2>
    <p><strong>Duration:</strong> <?php echo htmlspecialchars($course['duration']); ?></p>
    <p><strong>Level:</strong> <?php echo htmlspecialchars($course['level']); ?></p>
    <p><strong>Price:</strong> ৳<?php echo number_format($course['price'], 2); ?></p>
    <p><strong>Rating:</strong> <?php echo str_repeat("⭐", intval($course['rating'])); ?></p>

    <form action="dbfile/enrollment_db.php" method="POST">
      <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
      <button type="submit" class="btn btn-success mt-3">Confirm Enrollment</button>
      <a href="index.php" class="btn btn-secondary mt-3">Cancel</a>
    </form>
  </div>
</body>
</html>
