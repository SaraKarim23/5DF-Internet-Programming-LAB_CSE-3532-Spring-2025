<?php
  if (!isset($_SESSION['username'])) {
    $username = "";
  }
  else {
    $username = htmlspecialchars($_SESSION['username']);
  }
?>

<style>
    .navbar-brand span {
      color: #0d6efd;
    }

    .navbar .nav-link {
      color: white !important;
      font-weight: 500;
    }
</style>
<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark p-3">
    <div class="container-fluid">
        <a class="navbar-brand fs-1" href="index.php"><span>I</span>ncipient</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                <?php if ($username): ?>
                <li class="nav-item"><a class="btn btn-outline-primary" href="instractor.php">Our Instructor</a></li>
                <li class="nav-item"><a class="btn btn-outline-primary" href="langeluage_c.php">C</a></li>
                <li class="nav-item"><a class="btn btn-outline-primary" href="language_c_plus.php">C++</a></li>
                <li class="nav-item"><a class="btn btn-outline-primary" href="enrollmented.php">Enroll</a></li>
                <li class="nav-item text-white mt-2">Hello, <?php echo $username; ?></li>
                <li class="nav-item"><a class="btn btn-outline-danger" href="logout.php">Logout</a></li>
                <?php else: ?>
                <li class="nav-item"><a class="btn btn-outline-primary" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
