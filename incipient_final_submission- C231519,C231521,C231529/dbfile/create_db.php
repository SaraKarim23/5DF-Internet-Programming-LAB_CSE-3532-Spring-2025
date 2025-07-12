<?php
require 'connection.php'; // DB connection file

// Create table if not exists (example table: users)
$sql = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!$conn->query($sql)) {
    die("users Table creation failed: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS `courses` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `coursename` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT,
    `image` TEXT DEFAULT NULL,
    `rating` INT(11) UNSIGNED DEFAULT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `duration` VARCHAR(50), -- e.g., '10 weeks' or '30 hours'
    `level` ENUM('Beginner', 'Intermediate', 'Advanced') DEFAULT 'Beginner',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (`price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!$conn->query($sql)) {
    die("courses Table creation failed: " . $conn->error);
}

$sql = "INSERT INTO `courses` (`coursename`, `description`, `image`, `rating`, `price`, `duration`, `level`)
    VALUES 
    ('C Language', 'Learn the fundamentals of C programming.', 'images/cou.png', 5, 350.00, '30 hours', 'Beginner'),
    ('Kotlin', 'Master Kotlin for Android development.', 'images/cou1.png', 5, 350.00, '30 hours', 'Beginner'),
    ('Python', 'Comprehensive Python programming course.', 'images/cou2.png', 5, 500.00, '40 hours', 'Beginner'),
    ('JavaScript', 'Learn JavaScript from scratch.', 'images/cou5.png', 5, 700.00, '50 hours', 'Beginner');";

if (!$conn->query($sql)) {
    die("courses Table creation failed: " . $conn->error); 
}

$sql = "CREATE TABLE IF NOT EXISTS `enrollments` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT(11) UNSIGNED NOT NULL,
    `course_id` INT(11) UNSIGNED NOT NULL,
    `enrolled_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `status` ENUM('active', 'completed', 'dropped') DEFAULT 'active',
    `payment_amount` DECIMAL(10,2) DEFAULT 0.00,

    UNIQUE KEY `unique_enrollment` (`user_id`, `course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (!$conn->query($sql)) {
    die("enrollments Table creation failed: " . $conn->error);
}

echo "Database and table are ready.";
?>
