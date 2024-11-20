<?php
require_once '../backend/db.php'; // Adjust the path if needed

// Start the session
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $course_id = $_POST['course_id']; // Passed from the form as a hidden field
    $title = $_POST['postTitle'];
    $description = $_POST['postContent'];

    // Validate inputs
    if (empty($title) || empty($description) || empty($course_id)) {
        echo json_encode(['error' => 'All fields are required.']);
        exit();
    }

    try {
        // Prepare the SQL query for inserting the timeline post
        $sql = "INSERT INTO timeline_posts (user_id, course_id, title, description) 
                VALUES (:user_id, :course_id, :title, :description)";
        
        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters to the SQL query
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect or show a success message
            header("Location: ../frontend/course.php?id=$course_id&success=1");
            exit();
        } else {
            // Error during insertion
            echo json_encode(['error' => 'Failed to create post.']);
        }
    } catch (PDOException $e) {
        // Handle PDO errors (database-related issues)
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
