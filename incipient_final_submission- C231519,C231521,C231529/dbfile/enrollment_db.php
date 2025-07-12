<?php
    session_start();
    
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = intval(trim($_SESSION['user_id']));

    require 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_id = trim($_POST['course_id'] ?? '');

        if (empty($course_id) || !is_numeric($course_id)) {
            $_SESSION['error'] = "Invalid course selection.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $course_id = intval($course_id);

        // Check if course exists
        $stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $_SESSION['error'] = "Course not found.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $course = $result->fetch_assoc();
        $stmt->close();

        // Check if already enrolled
        $stmt = $conn->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "You are already enrolled in this course.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $stmt->close();

        // Insert enrollment
        $stmt = $conn->prepare("INSERT INTO enrollments (user_id, course_id, payment_amount) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $user_id, $course_id, $course['price']);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Course enrolled successfully.";
        } else {
            $_SESSION['error'] = "Failed to enroll in course.";
        }

        $stmt->close();
        header("Location: ../index.php");
        exit();
    }

    $conn->close();
?>
