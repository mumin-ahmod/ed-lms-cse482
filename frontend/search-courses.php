<?php
// Include the database connection
require_once 'db.php';  // Adjust the path if necessary

// Get the search query from the URL
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Initialize an empty array for courses
$courses = [];

// If search query exists, fetch courses that match
if ($searchQuery) {
    $stmt = $pdo->prepare("SELECT * FROM course WHERE Title LIKE :searchQuery OR Description LIKE :searchQuery");
    $stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If no search query, fetch all courses
    $stmt = $pdo->query("SELECT * FROM course");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Return the courses as a JSON response
return $courses;
