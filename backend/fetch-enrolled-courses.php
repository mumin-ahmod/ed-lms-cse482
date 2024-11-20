<?php
require_once '../backend/db.php'; // Adjust the path if needed
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    // Fetch enrolled courses for the logged-in user
    $sql = "
        SELECT course.Id, course.Title, course.Description, course.Start_date, course.End_date 
        FROM students 
        JOIN courses ON students.course_id = course.Id 
        WHERE students.user_id = :user_id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($courses);
} catch (Exception $e) {
    echo json_encode(['error' => 'Failed to fetch courses.']);
}
