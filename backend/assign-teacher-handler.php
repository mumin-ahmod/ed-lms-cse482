<?php
include 'db.php';

if (isset($_POST['course_id']) && isset($_POST['user_id'])) {
    $course_id = $_POST['course_id'];
    $user_id = $_POST['user_id'];

    // Insert the course-user assignment in the teachers table
    // Check if the assignment already exists for the given user_id and course_id
    $sql = "INSERT INTO teachers (user_id, course_id) VALUES (:user_id, :course_id)
            ON DUPLICATE KEY UPDATE course_id = :course_id";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['user_id' => $user_id, 'course_id' => $course_id])) {
        // Redirect back to the assign-teacher page with success message
        header("Location: ../frontend/assign-teacher.php?success=1");
    } else {
        echo "Failed to assign teacher.";
    }
    exit();
} else {
    echo "Invalid input.";
}
