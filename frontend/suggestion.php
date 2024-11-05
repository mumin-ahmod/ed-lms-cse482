<?php
include '../backend/db.php'; // Make sure the path to db.php is correct

if (isset($_POST['suggestion'])) {
    $suggestion = htmlspecialchars(ucfirst($_POST['suggestion'])); // Escape special characters for HTML

    // Prepare the SQL statement
    $query = "SELECT Title FROM course WHERE Title LIKE :suggestion";
    $stmt = $pdo->prepare($query);

    // Bind the parameter
    $stmt->execute(['suggestion' => "%$suggestion%"]);

    // Fetch results
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch()) {
            echo $row['Title'] . "<br />"; // Display the course title
        }
    } else {
        echo "No courses found.";
    }
}
