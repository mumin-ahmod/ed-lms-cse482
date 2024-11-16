<?php
// fetch-courses.php

// Include database connection
require_once 'db.php'; // Adjust the path if needed

try {
    // Fetch all courses from the database
    $sql = "SELECT * FROM course";
    $stmt = $pdo->query($sql);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return courses as JSON
    echo json_encode($courses);
} catch (PDOException $e) {
    // Handle errors and return empty array
    echo json_encode([]);
    error_log("Error fetching courses: " . $e->getMessage());
}
?>
