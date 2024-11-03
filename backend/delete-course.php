<!-- delete-course.php -->
<?php
include 'db.php'; // Include database connection

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM Course WHERE Id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $course_id]);

    // Redirect to the courses page after deletion
    header("Location: admin-course.php");
    exit();
} else {
    echo "Invalid course ID.";
}
?>