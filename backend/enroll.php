<?php
require_once 'db.php'; // Include database connection
session_start(); // Start session to get logged-in user info

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'You must be logged in to enroll.']);
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $course_id = filter_var($_POST['course_id'], FILTER_SANITIZE_NUMBER_INT);

    if (empty($course_id)) {
        echo json_encode(['success' => false, 'message' => 'Invalid course ID.']);
        exit();
    }

    try {
        // Check if the user is already enrolled
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM students WHERE user_id = :user_id AND course_id = :course_id");
        $stmt->execute(['user_id' => $user_id, 'course_id' => $course_id]);
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['success' => false, 'message' => 'You are already enrolled in this course.']);
            exit();
        }

        // Insert into students table
        $stmt = $pdo->prepare("INSERT INTO students (user_id, course_id) VALUES (:user_id, :course_id)");
        $stmt->execute(['user_id' => $user_id, 'course_id' => $course_id]);

        header('Location: ../frontend/dashboard.php');
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
