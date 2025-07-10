<!-- donation.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Page</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(120deg,rgb(184, 253, 255),rgb(82, 238, 255));
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .donation-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .donation-container h1 {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .donation-container label {
            font-weight: 600;
            color: #555;
        }

        .donation-container .btn-custom {
            background-color: #53E4DA;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            animation: pulse 1s infinite;
        }

        .donation-container .btn-custom:hover {
            background-color: #45c6b9;
        }

        .thank-you-message {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .thank-you-message p {
            font-size: 1.2rem;
            color: #28a745;
        }

        @keyframes pulse {
            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }
    </style>
</head>

<body>
    <?php
    // Example backend logic to retrieve the current raised amount
    // In practice, this value would come from a database
    $raisedAmount = 450000; // Example amount fetched from a database
    $targetAmount = 1000000; // Fixed target amount
    ?>

    <div class="container donation-container animate__animated animate__fadeInUp">
        <h1 class="animate__animated animate__fadeInDown animate__bounce">Donate Now</h1>
        <form id="donationForm" action="process_donation.php" method="POST" class="animate__animated animate__fadeIn">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control animate__animated animate__fadeInLeft" id="name"
                    name="name" placeholder="Enter your full name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control animate__animated animate__fadeInRight" id="email"
                    name="email" placeholder="Enter your email address" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Donation Amount (Tk)</label>
                <input type="number" class="form-control animate__animated animate__fadeInLeft" id="amount"
                    name="amount" placeholder="Enter the amount to donate" required>
            </div>
            <div class="mb-3">
                <label for="targetAmount" class="form-label">Target Amount (Tk)</label>
                <div class="form-control animate__animated animate__fadeInRight" id="targetAmount" style="background-color: #e9ecef; pointer-events: none;">
                    10,00,000
                </div>
            </div>
            
            
            <div class="mb-3">
                <label for="raisedAmount" class="form-label">Raised Amount (Tk)</label>
                <input type="number" class="form-control animate__animated animate__fadeInLeft" id="raisedAmount"
                    value="<?php echo $raisedAmount; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message (Optional)</label>
                <textarea class="form-control animate__animated animate__fadeInRight" id="message" name="message" rows="3"
                    placeholder="Write a message (optional)"></textarea>
            </div>
            <button type="submit" class="btn btn-custom w-100 animate__animated animate__zoomIn">Submit Donation</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>

</html>
