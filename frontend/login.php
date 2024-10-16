<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        /* Custom styles */
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .tab-content-container {
            padding-top: 20px;
        }

        .login-btn {
            width: 100%;
            margin-top: 15px;
        }

        .forgot-password {
            text-align: right;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<?php
// Check if the 'message' cookie is set
if (isset($_COOKIE['message'])) {
    echo "<div class='alert alert-warning'>" . htmlspecialchars($_COOKIE['message']) . "</div>";
    // Clear the cookie by setting it to expire in the past
    //setcookie('message', '', time() - 3600, '/');
}
?>


    <div class="container">

        <div class="login-container">
            <h2 class="text-center">Login</h2>
            <!-- Tabs -->
            <ul class="nav nav-tabs justify-content-center" id="loginTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="user-login-tab" data-bs-toggle="tab" data-bs-target="#user-login" type="button" role="tab" aria-controls="user-login" aria-selected="true">Student Login</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="admin-login-tab" data-bs-toggle="tab" data-bs-target="#admin-login" type="button" role="tab" aria-controls="admin-login" aria-selected="false">Teacher Login</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content tab-content-container" id="loginTabContent">

                <!-- User Login Form (Student) -->
                <div class="tab-pane fade show active" id="user-login" role="tabpanel" aria-labelledby="user-login-tab">
                    <form id="user-login-form" action="../backend/login.php" method="POST">
                        <input type="hidden" name="role" value="student"> <!-- Hidden field to identify role -->

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="user-email-field" class="form-label">Email</label>
                            <input type="email" class="form-control" id="user-email-field" name="email" placeholder="Enter your email" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="user-password-field" class="form-label">Password</label>
                            <input type="password" class="form-control" id="user-password-field" name="password" placeholder="Enter your password" required>
                        </div>
                        <a href="frontend/register.php" class="btn btn-outline">Register</a>
                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary login-btn">Login</button>
                    </form>
                </div>

                <!-- Admin Login Form (Teacher) -->
                <div class="tab-pane fade" id="admin-login" role="tabpanel" aria-labelledby="admin-login-tab">
                    <form id="admin-login-form" action="../backend/login.php" method="POST">
                        <input type="hidden" name="role" value="teacher"> <!-- Hidden field to identify role -->

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="admin-email-field" class="form-label">Email</label>
                            <input type="email" class="form-control" id="admin-email-field" name="email" placeholder="Enter your email" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="admin-password-field" class="form-label">Password</label>
                            <input type="password" class="form-control" id="admin-password-field" name="password" placeholder="Enter your password" required>
                        </div>

                        <a href="frontend/register.php" class="btn btn-outline">Register</a>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary login-btn">Login</button>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>