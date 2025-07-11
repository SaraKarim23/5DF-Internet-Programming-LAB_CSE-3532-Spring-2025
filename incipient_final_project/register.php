<?php
session_start();
if (isset($_SESSION['username'])) {
  header('Location: index.php');
  exit();
}

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register | INCIPIENT</title>
  <link rel="icon" type="image/jpeg" href="images/incipientlogo.jpeg">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <!-- Google Fonts: Roboto -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Roboto', sans-serif;
    }


    body {
      background-color: #000;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      background-color: #b2bec3;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .input-icon {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #b2bec3;
    }

    .position-relative input {
      padding-right: 2.5rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card p-4">
          <h2 class="text-center text-primary mb-4">Register</h2>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center" role="alert">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>

          <form action="dbfile/register_db.php" method="post">
            <div class="mb-3 position-relative">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
              <i class='bx bxs-user input-icon'></i>
            </div>

            <div class="mb-3 position-relative">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
              <i class='bx bxs-envelope input-icon'></i>
            </div>

            <div class="mb-3 position-relative">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              <i class='bx bxs-lock-alt input-icon'></i>
            </div>

            <div class="mb-3 position-relative">
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
              <i class='bx bxs-lock-alt input-icon'></i>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">Register</button>
              <a href="login.php" class="btn btn-outline-secondary">Back to Login</a>
            </div>

            <div class="text-center mt-3">
              <a href="index.php" class="text-muted text-decoration-none">Return to homepage</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
