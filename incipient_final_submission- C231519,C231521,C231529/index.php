<?php
  session_start();
    
  // DB connection file
  require 'dbfile/connection.php';

  $error = $_SESSION['error'] ?? '';
  unset($_SESSION['error']);

  $success = $_SESSION['success'] ?? '';
  unset($_SESSION['success']);

  // Fetch courses from the database
  $sql = "SELECT * FROM courses ORDER BY id ASC";
  $courses = $conn->query($sql);
  $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>INCIPIENT</title>
  <link rel="icon" type="image/jpeg" href="images/incipientlogo.jpeg">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      font-family: 'Roboto', sans-serif;
    }

    .carousel-item img {
      height: 500px;
      object-fit: cover;
    }

    .d1 {
      text-align: center;
      color: white;
      font-size: 2rem;
      font-weight: bold;
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

  <!-- Carousel -->
  <div id="carouselExampleCaptions" class="carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/canva2.gif" class="d-block w-100" alt="Slide 1">
      </div>
      <div class="carousel-item">
        <img src="images/canva3.gif" class="d-block w-100" alt="Slide 2">
      </div>
      <div class="carousel-item">
        <img src="images/conva1.gif" class="d-block w-100" alt="Slide 3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <!-- Courses -->
  <div class="container my-5">
    <h3 class="d1 mb-4">OUR UPCOMING COURSES</h3>
    <div class="row g-4">
      <?php if ($courses && $courses->num_rows > 0): ?>
        <?php while($course = $courses->fetch_assoc()): ?>
          <div class="col-md-12 col-lg-6">
            <div class="course-card text-white text-center">
              <img src="<?php echo htmlspecialchars($course['image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($course['coursename']); ?>">
              <h4><?php echo htmlspecialchars($course['coursename']); ?></h4>

              <?php
                // Show stars based on rating
                $stars = intval($course['rating']);
                $starOutput = str_repeat("⭐", $stars);
              ?>
              <div class="text-warning"><?php echo $starOutput; ?></div>

              <div class="price my-2">৳<?php echo number_format($course['price'], 2); ?></div><a class="btn btn-secondary" href="enrollment.php?id=<?php echo urlencode($course['id']); ?>">Enroll</a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-white">No courses found.</p>
      <?php endif; ?>
    </div>
    <!-- <div class="row g-4">
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
    </div> -->
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
