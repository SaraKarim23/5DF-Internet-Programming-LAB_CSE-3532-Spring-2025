<?php
// Database connection (adjust your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blessed_hands";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $imagePath = $targetFilePath;
        } else {
            $error = "Image upload failed.";
        }
    }

    if (!$error) {
        if (!$name || !$email || !$subject || !$message) {
            $error = "Please fill all required fields.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $email, $subject, $message, $imagePath);
            if ($stmt->execute()) {
                $success = true;
            } else {
                $error = "Database error: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Blessed Hands</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animate.css -->
    <link href="https://cdn.jsdelivr.net/npm/animate.css/animate.min.css" rel="stylesheet" />
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
            border-color: #f8f9fa;
            padding: 5px 15px;
            background-color: #53E4DA;
        }
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #53E4DA;
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(237, 232, 232, 0.1);
        }
        .contact-box {
            padding: 60px 20px;
            margin-top: 20px;
            background-color: #f9f9f9;
            border-radius: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .info-wrap .info {
            margin-bottom: 20px;
            background: #e9f5f4;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .info-wrap .info i {
            color: #53E4DA;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .php-email-form {
            background: white;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .php-email-form input,
        .php-email-form textarea {
            border-radius: 5px;
            box-shadow: none;
            font-size: 14px;
        }
        .php-email-form button[type="submit"] {
            background: #53E4DA;
            border: 0;
            padding: 10px 24px;
            color: white;
            transition: background-color 0.3s;
            border-radius: 5px;
        }
        .php-email-form button[type="submit"]:hover {
            background: #46c9b6;
        }
        /* Image Section */
        .image-section {
            background-color: #e9f5f4;
            padding: 60px 20px;
        }
        .image-section img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }
        /* Animation */
        .animate__animated {
            opacity: 0;
            transform: translateY(50px);
            animation-fill-mode: both;
        }
        .animate__fadeIn {
            animation-name: fadeIn;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/BlessedHandslogo.png" alt="Blessed Hands Logo" style="height: 50px; margin-right: 10px;" /> Blessed Hands
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a href="login.php" class="btn btn-primary text-white">Sign Up</a></li>
                    <li class="nav-item"><a href="register.php" class="btn btn-primary text-white">Sign In</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main id="main">
        <!-- Contact Section -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="contact-box">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="info-wrap">
                                <div class="row">
                                    <div class="col-lg-4 info">
                                        <i class="bi bi-geo-alt"></i>
                                        <h4>Location:</h4>
                                        <p>IIUC, Kumira, Chittagong</p>
                                    </div>
                                    <div class="col-lg-4 info mt-4 mt-lg-0">
                                        <i class="bi bi-envelope"></i>
                                        <h4>Email:</h4>
                                        <p>info@example.com<br />contact@example.com</p>
                                    </div>
                                    <div class="col-lg-4 info mt-4 mt-lg-0">
                                        <i class="bi bi-phone"></i>
                                        <h4>Call:</h4>
                                        <p>+880-188888888<br />+880-188888877</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Show success/error messages -->
                            <?php if ($success): ?>
                                <div class="alert alert-success">Your message has been sent successfully!</div>
                            <?php elseif ($error): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>

                            <form action="" method="post" enctype="multipart/form-data" class="php-email-form animate__animated animate__fadeIn">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required />
                                    </div>
                                    <div class="col-md-6 form-group mt-3 mt-md-0">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required />
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required />
                                </div>
                                <div class="form-group mt-3">
                                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="image">Attach Image:</label>
                                    <input type="file" class="form-control" name="image" id="image" />
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center">
                                    <button type="submit">Send Message</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Section -->

        <!-- Image Section -->
        <section id="image-section" class="image-section">
            <div class="container">
                <div class="row justify-content-center" data-aos="fade-up">
                    <div class="col-lg-8">
                        <img src="images/contact-image.jpg" alt="Contact Image" class="img-fluid animate__animated animate__fadeIn" />
                    </div>
                </div>
            </div>
        </section>
        <!-- End Image Section -->
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
