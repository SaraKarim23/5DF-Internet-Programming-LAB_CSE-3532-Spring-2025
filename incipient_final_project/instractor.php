<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    $username = "";
  } else {
    $username = htmlspecialchars($_SESSION['username']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Instructors | INCIPIENT</title>
  <link rel="icon" type="image/jpeg" href="images/incipientlogo.jpeg">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #000;
      font-family: 'Roboto', sans-serif;
      color: white;
    }

    .navbar .nav-link {
      color: white !important;
      font-weight: 500;
    }

    .navbar-brand span {
      color: #0d6efd;
    }

    .section-title {
      font-size: 2rem;
      font-weight: bold;
      text-align: center;
      margin: 40px 0 20px;
    }

    .instructor-card {
      background-color: #1a1a1a;
      border-radius: 10px;
      padding: 15px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 0 10px rgba(255,255,255,0.05);
    }

    .instructor-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 20px rgba(255,255,255,0.15);
    }

    .instructor-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 10px;
    }

    .card-title {
      color: #fff;
    }

    .card-text {
      color: #ccc;
    }

    .btn-outline-light {
      border-color: #0dcaf0;
      color: #0dcaf0;
    }

    .course-card {
      background-color: #1a1a1a;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
      transition: transform 0.3s ease;
    }

    .course-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.15);
    }

    .course-card img {
      height: 120px;
      object-fit: contain;
    }

    .course-card h4 {
      color: white;
      font-size: 1.2rem;
      margin-top: 10px;
    }

    .course-card .price {
      font-weight: bold;
      color: #28a745;
    }

    #about a {
      color: #0dcaf0;
    }

    #about a:hover {
      text-decoration: underline;
    }

    footer {
      padding: 30px 0;
      text-align: center;
      color: white;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark p-3">
  <div class="container-fluid">
    <a class="navbar-brand fs-1" href="index.php"><span>I</span>ncipient</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
        <?php if ($username): ?>
          <li class="nav-item"><a class="btn btn-outline-primary" href="instractor.php">Our Instructor</a></li>
          <li class="nav-item"><a class="btn btn-outline-primary" href="langeluage_c.php">C</a></li>
          <li class="nav-item"><a class="btn btn-outline-primary" href="language_c_plus.php">C++</a></li>
          <li class="nav-item text-white mt-2">Hello, <?php echo $username; ?></li>
          <li class="nav-item"><a class="btn btn-outline-danger" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="btn btn-outline-primary" href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Instructors Section -->
<div class="container my-5">
  <h2 class="section-title">Meet Our Instructors</h2>
  <div class="row g-4">

    <div class="col-sm-6 col-lg-4">
      <div class="instructor-card text-center">
        <img src="images/w4.jpeg" alt="Maryam Tahira">
        <h4 class="card-title mt-3">Maryam Tahira</h4>
        <p class="card-text">Frontend Developer, CSE at IIUC</p>
        <div class="text-warning mb-2">⭐⭐⭐⭐⭐</div>
        <a href="https://www.linkedin.com/in/maryam-tahira-560270300" target="_blank" class="btn btn-outline-light w-100">LinkedIn</a>
      </div>
    </div>

    <div class="col-sm-6 col-lg-4">
      <div class="instructor-card text-center">
        <img src="images/w1 .jpeg" alt="Sakibul Islam Sakif">
        <h4 class="card-title mt-3">Sakibul Islam Sakif</h4>
        <p class="card-text">Studying in CSE at IIUC</p>
        <div class="text-warning mb-2">⭐⭐⭐⭐⭐</div>
        <a href="https://www.linkedin.com/in/error-mate" target="_blank" class="btn btn-outline-light w-100">LinkedIn</a>
      </div>
    </div>
    
    <div class="col-sm-6 col-lg-4">
      <div class="instructor-card text-center">
        <img src="images/w3.jpeg" alt="Umme Riazul Jannat Eiva">
        <h4 class="card-title mt-3">Umme Riazul Jannat Eiva</h4>
        <p class="card-text">Adj Lecturer at IIUC, Completed BSC in EEE at IIUC</p>
        <div class="text-warning mb-2">⭐⭐⭐⭐⭐</div>
        <a href="https://www.linkedin.com/in/error-mate" target="_blank" class="btn btn-outline-light w-100">LinkedIn</a>
      </div>
    </div>
    
    <div class="col-sm-6 col-lg-4">
      <div class="instructor-card text-center">
        <img src="images/halima2.jpeg" alt="Sakibul Islam Sakif">
        <h4 class="card-title mt-3">Halima Khatoon</h4>
        <p class="card-text">Teacher (19 years), English Language</p>
        <div class="text-warning mb-2">⭐⭐⭐⭐⭐</div>
        <a href="https://www.linkedin.com/in/error-mate" target="_blank" class="btn btn-outline-light w-100">LinkedIn</a>
      </div>
    </div>

    <div class="col-sm-6 col-lg-4">
      <div class="instructor-card text-center">
        <img src="images/nishat1.jpg" alt="Sakibul Islam Sakif">
        <h4 class="card-title mt-3">Nishat Tasnim</h4>
        <p class="card-text">Frontend Developer, Studying CSE at IIUC</p>
        <div class="text-warning mb-2">⭐⭐⭐⭐⭐</div>
        <a href="https://www.linkedin.com/in/error-mate" target="_blank" class="btn btn-outline-light w-100">LinkedIn</a>
      </div>
    </div>
    
    <div class="col-sm-6 col-lg-4">
      <div class="instructor-card text-center">
        <img src="images/mallika1.jpeg" alt="Sakibul Islam Sakif">
        <h4 class="card-title mt-3">Mallika Barua</h4>
        <p class="card-text">Frontend Developer, Studying CSE at IIUC</p>
        <div class="text-warning mb-2">⭐⭐⭐⭐⭐</div>
        <a href="https://www.linkedin.com/in/error-mate" target="_blank" class="btn btn-outline-light w-100">LinkedIn</a>
      </div>
    </div>
  </div>
</div>

  <!-- Courses -->
  <div class="container my-5">
    <h3 class="d1 mb-4">OUR UPCOMING COURSES</h3>
    <div class="row g-4">
      <div class="col-md-12 col-lg-6">
        <div class="course-card text-white text-center">
          <img src="images/cou.png" class="img-fluid" alt="">
          <h4>C Language</h4>
          <div class="text-warning">⭐⭐⭐⭐⭐</div>
          <div class="price my-2">৳350</div>
          <button class="btn btn-secondary">Enroll</button>
        </div>
      </div>
      <div class="col-md-12 col-lg-6">
        <div class="course-card text-white text-center">
          <img src="images/cou1.png" class="img-fluid" alt="">
          <h4>Kotlin</h4>
          <div class="text-warning">⭐⭐⭐⭐⭐</div>
          <div class="price my-2">৳350</div>
          <button class="btn btn-secondary">Enroll</button>
        </div>
      </div>
      <div class="col-md-12 col-lg-6">
        <div class="course-card text-white text-center">
          <img src="images/cou2.png" class="img-fluid" alt="">
          <h4>Python</h4>
          <div class="text-warning">⭐⭐⭐⭐⭐</div>
          <div class="price my-2">৳500</div>
          <button class="btn btn-secondary">Enroll</button>
        </div>
      </div>
      <div class="col-md-12 col-lg-6">
        <div class="course-card text-white text-center">
          <img src="images/cou5.png" class="img-fluid" alt="">
          <h4>JavaScript</h4>
          <div class="text-warning">⭐⭐⭐⭐⭐</div>
          <div class="price my-2">৳700</div>
          <button class="btn btn-secondary">Enroll</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Contact Section -->
  <section class="container my-5 text-white" id="about">
    <h2 class="text-center mb-4">Contact Details</h2>
    <div class="row align-items-center">
      <div class="col-md-5 text-center">
        <img src="images/incipientlogo.jpeg" class="img-fluid" alt="Incipient Logo">
      </div>
      <div class="col-md-7">
        <p class="h4 text-center">Welcome to INCIPIENT - The World of Knowledge</p>
        <p class="text-success text-center">“Any sufficiently advanced technology is indistinguishable from magic.”</p>
        <p class="text-center">📞 <a href="tel:01985857516">Call Us</a></p>
        <p class="text-center">📧 <a href="mailto:incipient406@gmail.com">incipient406@gmail.com</a></p>
        <p class="text-center">📘 <a href="https://www.facebook.com/profile.php?id=61556234462123">Facebook</a></p>
        <p class="text-center">📸 <a href="https://www.instagram.com/incipient2024">Instagram</a></p>
      </div>
    </div>
  </section>

<!-- Footer -->
<footer class="bg-dark">
  <p>&copy; 2025 Incipient. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
