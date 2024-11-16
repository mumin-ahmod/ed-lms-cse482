<?php
include 'db.php'; // Adjust the path to your database connection file

// Check if user_id and role are set in the URL
if (isset($_GET['user_id']) && isset($_GET['role'])) {
    $user_id = $_GET['user_id'];
    $new_role = $_GET['role'];

    // Prepare the SQL query to update the role of the user
    $sql = "UPDATE users SET Role = :role WHERE Id = :user_id";
    $stmt = $pdo->prepare($sql);

    // Execute the statement with provided user_id and new role
    if ($stmt->execute(['role' => $new_role, 'user_id' => $user_id])) {
        // Success message or any other action after role is updated
        echo "Role updated successfully.";
    } else {
        // Error message if the update fails
        echo "Failed to update role.";
    }
}

// Redirect back to the Change Role page
header("Location: ../frontend/change-role.php"); // Adjust path if necessary
exit();
