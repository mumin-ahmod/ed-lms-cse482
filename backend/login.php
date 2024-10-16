<?php
// Include db.php to get the $pdo object
require_once 'db.php'; // Ensure db.php is included

session_start(); // Start the session

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Validate inputs
    if (empty($email) || empty($password) || empty($role)) {
        setcookie('message', 'All fields are required.', time() + 5, '/');
        header('Location: ../frontend/home.php'); // Redirect back to login page
        exit();
    }

    // Prepare a single query with role as a parameter
    $sql = "SELECT * FROM users WHERE email = :email AND role = :role LIMIT 1";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);

    // Execute the query
    $stmt->execute();

    // Fetch the user from the database
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify if user exists and the password matches
    if ($user && password_verify($password, $user['Password'])) {
        session_regenerate_id(true); // Prevent session fixation

        // Store user info in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($role === 'student') {
            header('Location: ../frontend/dashboard.php');
        } elseif ($role === 'teacher') {
            header('Location: ../frontend/teacher-dashboard.php');
        }
        exit();
    } else {
        // Invalid credentials
        setcookie('message', 'Invalid email, password or role.', time() + 5, '/');
        header('Location: ../frontend/home.php'); // Redirect back to login page
        exit();
    }
} else {
    // If the request method is not POST, deny access
    setcookie('message', 'Invalid request method.', time() + 5, '/');
    header('Location: ../frontend/home.php'); // Redirect back to login page
    exit();
}
?>
