<?php
// Include db.php to get the $pdo object
require_once 'db.php';

session_start(); // Start the session

// Default admin credentials
$admin_email = 'admin@gmail.com';
$admin_password = 'admin123456';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Validate inputs
    if (empty($email) || empty($password) || empty($role)) {
        setcookie('message', 'All fields are required.', time() + 5, '/');
        header('Location: ../frontend/home.php');
        exit();
    }

    // Check if the user is the default admin
    if ($email === $admin_email && $password === $admin_password && $role === 'admin') {
        // Set session variables for admin
        session_regenerate_id(true);
        $_SESSION['user_id'] = 'admin';
        $_SESSION['role'] = 'admin';

        // Redirect to the admin dashboard
        header('Location: ../frontend/admin-dashboard.php');
        exit();
    }

    // If not admin, check in the database
    $sql = "SELECT * FROM users WHERE email = :email AND role = :role LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify if user exists and the password matches
    if ($user && password_verify($password, $user['Password'])) {
        session_regenerate_id(true);
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
        setcookie('message', 'Invalid email, password or role.', time() + 5, '/');
        header('Location: ../frontend/login.php');
        exit();
    }
} else {
    setcookie('message', 'Invalid request method.', time() + 5, '/');
    header('Location: ../frontend/login.php');
    exit();
}
