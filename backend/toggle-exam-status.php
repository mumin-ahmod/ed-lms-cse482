<?php
// Include the database connection
include '../backend/db.php';

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Validate required parameters from POST
if (!isset($_POST['id']) || !isset($_POST['course_id'])) {
    die("Missing required parameters.");
}

$exam_id = intval($_POST['id']);
$course_id= intval($_POST['course_id']);

echo $exam_id, $course_id;

try {
    // Verify that the exam exists and belongs to this user and course
    $verify_query = "SELECT id, status FROM exams WHERE id = ? AND course_id = ? AND user_id = ?";
    $verify_stmt = $pdo->prepare($verify_query);
    $verify_stmt->execute([$exam_id, $course_id, $_SESSION['user_id']]);
    $exam = $verify_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$exam) {
        $_SESSION['error'] = "Exam not found or you don't have permission to modify it.";
        header("Location: ../frontend/teacher-course.php?id=".$course_id);
        exit();
    }

    // Toggle the status between 'published' and 'unpublished'
    $new_status = ($exam['status'] === 'published') ? 'unpublished' : 'published';
    
    // Update the exam status
    $update_query = "UPDATE exams SET status = ? WHERE id = ?";
    $update_stmt = $pdo->prepare($update_query);
    $result = $update_stmt->execute([$new_status, $exam_id]);

    if ($result) {
        $_SESSION['success'] = "Exam status updated successfully. Status is now " . ucfirst($new_status) . ".";
    } else {
        $_SESSION['error'] = "Failed to update exam status.";
    }

} catch (Exception $e) {
    $_SESSION['error'] = "An error occurred: " . $e->getMessage();
}

// Redirect back to the exam list page
header("Location: ../frontend/teacher-course.php?id=".$course_id);
exit();
