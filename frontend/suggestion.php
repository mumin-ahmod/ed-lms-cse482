<?php
// Include the database configuration file with PDO connection
include '../backend/db.php';

if (isset($_POST['suggestion'])) {
    // Use PDO to safely prepare and execute the query
    $suggestion = ucfirst($_POST['suggestion']);
    $query = "SELECT Title FROM course WHERE Title LIKE :suggestion";

    // Prepare the statement
    $stmt = $pdo->prepare($query);

    // Bind the parameter with wildcards for partial matching
    $stmt->execute(['suggestion' => '%' . $suggestion . '%']);

    // Check if there are any results
    if ($stmt->rowCount() > 0) {
        // Fetch and display each row
        while ($row = $stmt->fetch()) {
            echo $row['Title'] . "<br />";
        }
    } else {
        echo "No Title found.";
    }
}

// Close the connection (optional, as PDO does this automatically at the end of the script)
$pdo = null;
