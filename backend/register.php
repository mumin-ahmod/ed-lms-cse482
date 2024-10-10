<?php
// Include the database connection
require 'db.php'; // Ensure you have the correct path to your db.php file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $role = htmlspecialchars(trim($_POST['role'])) ?: 'student'; // Default to 'student' if not selected

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO users (Name, Email, Phone, Role) VALUES (:name, :email, :phone, :role)");
        
        // Bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':role', $role);

        // Execute the statement
        $stmt->execute();

        // Redirect to a success page or display a success message
        header("Location: ../success.php"); // Replace with your success page
        exit();

    } catch (PDOException $e) {
        // Handle any errors
        echo "Error: " . $e->getMessage();
    }
}
?>
