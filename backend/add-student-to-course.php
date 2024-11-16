<?php
include 'db.php';

if (isset($_POST['user_id']) && isset($_POST['course_id'])) {
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];

    // Check if the course with the given course_id exists (correct column name is Id)
    $sql = "SELECT COUNT(*) FROM course WHERE Id = :course_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['course_id' => $course_id]);
    $course_exists = $stmt->fetchColumn();

    if (!$course_exists) {
        echo "Course does not exist.";
        exit();
    }

    // Insert student into the course
    $sql = "INSERT INTO teachers (user_id, course_id) VALUES (:user_id, :course_id)
            ON DUPLICATE KEY UPDATE user_id = :user_id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['user_id' => $user_id, 'course_id' => $course_id])) {
        header("Location: ../frontend/teacher-course.php?course_id=$course_id&success=1");
    } else {
        echo "Failed to add student to course.";
    }
    exit();
} else {
    echo "Invalid input.";
}
