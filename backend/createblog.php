<?php
// Include your database connection file
include '../backend/db.php'; // Ensure this points to the correct path for db.php

// Initialize variables
$title = $content = $author = "";
$errors = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form inputs
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $author = trim($_POST['author']);

    // Validate form inputs
    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    if (empty($content)) {
        $errors[] = "Content is required.";
    }
    if (empty($author)) {
        $errors[] = "Author is required.";
    }

    // If no errors, insert the data into the database
    if (empty($errors)) {
        try {
            // Prepare the SQL statement
            $stmt = $pdo->prepare("INSERT INTO blogs (title, content, author) VALUES (:title, :content, :author)");

            // Bind parameters
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':author', $author);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: ../frontend/create-blog.php?success=1");
                exit;
            } else {
                $errors[] = "Failed to create the blog post.";
            }
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }

    // If there are errors, redirect back with errors
    if (!empty($errors)) {
        $queryString = http_build_query(['errors' => $errors]);
        header("Location: ../frontend/create-blog.php?$queryString");
        exit;
    }
}
