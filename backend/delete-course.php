<?php
// delete-course.php

// Include database connection
include 'db.php';

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM Course WHERE Id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $course_id]);

    // Redirect to the course management page after deletion
    header("Location: ../frontend/admin-course.php");
    exit();
} else {
    echo "Invalid course ID.";
}
