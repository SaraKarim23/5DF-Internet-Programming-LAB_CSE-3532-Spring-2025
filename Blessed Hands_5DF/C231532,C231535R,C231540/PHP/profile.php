<?php 
    include("connection.php");
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blessed Hands</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Vendor CSS -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <style>
      body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        .navbar-brand {
            font-weight: bold;
            color: #53E4DA;
        }

        .navbar-nav a {
            color: #034a57;
            margin: 0 10px;
            text-decoration: none;
            font-weight: 500;
        }

        .navbar-nav .btn {
            border-radius: 15px;
            padding: 5px 15px;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 15px;
            background-color: #e9f5f4;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding-bottom: 10px;
        }

        .hero-text {
            max-width: 600px;
            text-align: left;
            margin-bottom: 100px; 
        }

        .hero-text h1 {
            font-size: 3rem;
            color: #033357;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .hero-text p {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .hero-text .btn {
            padding: 10px 25px;
            font-size: 1rem;
            border-radius: 90px;
            text-transform: uppercase;
            background-color: #53E4DA;
            border: none;
            color: white;
        }

        .hero-text .btn:hover {
            background-color: #45c6b9;
        }

        .btn-primary {
            background-color: #53E4DA;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #45c6b9;
        }

        .hero-illustration img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .campaign-section {
            padding: 50px 20px;
            background-color: #f8f9fa;
        }
        .container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
}

.row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap; /* Ensures responsive stacking on smaller screens */
    align-items: center; /* Aligns items vertically */
}

/* For smaller screens */
@media (max-width: 768px) {
    .row {
        flex-direction: column; /* Stack sections vertically */
    }
}


        .campaign-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .campaign-card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .campaign-card h2 {
            font-size: 1.5rem;
            color: rgb(43, 35, 32);
            margin: 15px 0;
        }

        .campaign-card p {
            margin: 5px 0;
        }

        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #53E4DA;
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .cta-box {
            background: #e9f5f4;
            border: 1px solid #53E4DA;
            border-radius: 10px;
            padding: 40px;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .cta-box h3 {
            color: #53E4DA;
            margin-bottom: 15px;
        }

        .cta-box p {
            color: #6c757d;
            margin-bottom: 20px;
        }

      footer {
            text-align: center;
            background-color: #f8f9fa;
            padding: 20px;
            color: #6c757d;
        }
       /* Parent container styling */
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: stretch;
    gap: 20px; /* Add some space between the containers */
}

/* For individual sections */
.content-container, .animation-container {
    flex: 1; /* Make both containers take equal space */
    min-width: 45%; /* Ensure they fit on smaller screens */
    max-width: 48%; /* Ensure they maintain size on larger screens */
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
    padding: 20px;
}

/* Lottie animation specific styling */
.animation-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    text-align: center;
    background-color: #e9f5f4;
}

/* Animations */
.animated-element {
    animation: fadeInUp 1.5s ease-in-out infinite alternate;
}

@keyframes fadeInUp {
    0% {
        transform: translateY(30px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

.lottie-animation {
    width: 100%;
    max-width: 500px;
    margin: auto;
}

    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/BlessedHandslogo.png" alt="Blessed Hands Logo" style="height: 50px; margin-right: 10px;">
                Blessed Hands
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contract.php">Contact</a></li>
                   
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle animate__animated" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-lg-inline"><?php echo $name ?? ''; ?></span>
                            <img class="rounded-circle" src="images/profile.jpeg" alt="Profile" style="height: 40px; width: 40px;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end animate_animated animate_fadeInDown" id="dropdownMenu">
                            <li><a class="dropdown-item" href="User_profile.php"><i class="bi bi-person-fill me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear-fill me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="index.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

   <!-- Hero Section -->
<div class="container hero">
    <div class="hero-text animate__animated animate__fadeInLeft">
        <h1>Every Donation Creates a Ripple of Hope</h1>
        <p>Join our mission to make a difference in the world. With every donation, we bring hope, healing, and joy to
            those in need. Your generosity can transform lives and create a brighter future for all.</p>
        <a href="donation.php" class="btn btn-primary animate__animated animate__pulse animate__infinite">Donate Now</a>
    </div>
    <div class="hero-illustration animate__animated animate__fadeInRight">
        <img src="images/homelogo.png" alt="Hero Illustration">
    </div>
</div>

    <main>
    <div class="container">
     <!-- CTA and Campaign Carousel Container -->
     <div class="content-container">
        <div class="cta-section animate__animated animate__zoomIn" style="padding: 20px; background-color: #e9f5f4; border: 1px solid #53E4DA; border-radius: 15px; margin-bottom: 20px; text-align: center;">
            <h3>Join the Movement</h3>
            <p>Be a part of something great. Sign up now and make a difference!</p>
            <button class="btn btn-primary animate__animated animate__bounceIn">Get Started</button>
        </div>

        <!-- Campaign Carousel -->
        <div id="campaignCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="campaign-card animate__animated animate__fadeInUp" style="padding: 10px; background-color: white; border: 1px solid #ddd; border-radius: 10px;">
                        <img src="images/Gaza.jpg" alt="Campaign 1" style="width: 100%; border-radius: 5px;">
                        <h2 style="color: rgb(43, 35, 32); font-size: 1rem;">Support Palestine with Your Zakat and Sadaqah</h2>
                        <p><strong>Raised:</strong> <span class="text-success">Tk 5,000.00</span></p>
                        <p><strong>Goal:</strong> <span class="text-danger">Tk 50,000.00</span></p>
                        <a href="donation.html" class="btn btn-primary animate__animated animate__heartBeat animate__infinite">Donate Now</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="campaign-card animate__animated animate__fadeInUp" style="padding: 10px; background-color: white; border: 1px solid #ddd; border-radius: 10px;">
                        <img src="images/Child-food.jpg" alt="Campaign 2" style="width: 100%; border-radius: 5px;">
                        <h2 style="color: rgb(43, 35, 32); font-size: 1rem;">Child Food Poverty: Nutrition deprivation in early childhood</h2>
                        <p><strong>Raised:</strong> <span class="text-success">Tk 9,000.00</span></p>
                        <p><strong>Goal:</strong> <span class="text-danger">Tk 90,000.00</span></p>
                        <a href="child_food.php" class="btn btn-primary animate__animated animate__heartBeat animate__infinite">Donate Now</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="campaign-card animate__animated animate__fadeInUp" style="padding: 10px; background-color: white; border: 1px solid #ddd; border-radius: 10px;">
                        <img src="images/BangladeshFlood.jpg" alt="Campaign 3" style="width: 100%; border-radius: 5px;">
                        <h2 style="color: rgb(43, 35, 32); font-size: 1rem;">Flood situation in Bangladesh</h2>
                        <p><strong>Raised:</strong> <span class="text-success">Tk 9,000.00</span></p>
                        <p><strong>Goal:</strong> <span class="text-danger">Tk 90,000.00</span></p>
                        <a href="child_food.php" class="btn btn-primary animate__animated animate__heartBeat animate__infinite">Donate Now</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev animate__animated animate__fadeInLeft" href="#campaignCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next animate__animated animate__fadeInRight" href="#campaignCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
     </div>

        <!-- Lottie Animation Container -->
        <div class="animation-container">
            <div class="animation-section">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player
                  src="https://assets2.lottiefiles.com/packages/lf20_jcikwtux.json"  
                  background="transparent"  
                  speed="1"  
                  style="width: 100%; max-width: 400px; height: auto;" 
                  loop  
                  autoplay>
                </lottie-player>
            </div>
        </div>
    </div>
</main>



<footer>
    <p>&copy; 2025 Blessed Hands. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
