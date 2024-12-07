<?php
// Start with PHP logic to handle cookies before any HTML output
if (isset($_COOKIE['message'])) {
    $message = htmlspecialchars($_COOKIE['message']);
    // Clear the cookie by setting it to expire in the past
    setcookie('message', '', time() - 3600, '/');
} else {
    $message = null; // Ensure $message is defined to avoid undefined variable errors
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="js"

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    <!-- Include Navbar -->
    <?php include  __DIR__ . '/header.php'; ?>

    <!-- set cookies here it will goes automitically after 3 sec -->
    <?php if ($message): ?>
        <div class='alert alert-warning' id='cookieMessage'><?= $message ?></div>
    <?php endif; ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                const messageDiv = document.getElementById('cookieMessage');
                if (messageDiv) {
                    messageDiv.style.display = 'none';
                }
            }, 3000); // 3000 milliseconds = 3 seconds
        });
    </script>

    <div class="container">
        <div class="login-container">
            <h2 class="text-center">Login</h2>
            <!-- Tabs -->
            <ul class="nav nav-tabs justify-content-center" id="loginTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="user-login-tab" data-bs-toggle="tab" data-bs-target="#user-login" type="button" role="tab" aria-controls="user-login" aria-selected="true">Student Login</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="teacher-login-tab" data-bs-toggle="tab" data-bs-target="#teacher-login" type="button" role="tab" aria-controls="teacher-login" aria-selected="false">Teacher Login</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="admin-login-tab" data-bs-toggle="tab" data-bs-target="#admin-login" type="button" role="tab" aria-controls="admin-login" aria-selected="false">Admin Login</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content tab-content-container" id="loginTabContent">

                <!-- Student Login Form -->
                <div class="tab-pane fade show active" id="user-login" role="tabpanel" aria-labelledby="user-login-tab">
                    <form id="user-login-form" action="./backend/login.php" method="POST">


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

                        <a href="register.php" class="btn btn-outline">Register</a>
                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary login-btn">Login</button>
                    </form>
                </div>

                <!-- Teacher Login Form -->
                <div class="tab-pane fade" id="teacher-login" role="tabpanel" aria-labelledby="teacher-login-tab">
                    <form id="teacher-login-form" action="./backend/login.php" method="POST">


                        <input type="hidden" name="role" value="teacher"> <!-- Hidden field to identify role -->

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="teacher-email-field" class="form-label">Email</label>
                            <input type="email" class="form-control" id="teacher-email-field" name="email" placeholder="Enter your email" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="teacher-password-field" class="form-label">Password</label>
                            <input type="password" class="form-control" id="teacher-password-field" name="password" placeholder="Enter your password" required>
                        </div>

                        <a href="register.php" class="btn btn-outline">Register</a>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary login-btn">Login</button>
                    </form>
                </div>

                <!-- Admin Login Form -->
                <div class="tab-pane fade" id="admin-login" role="tabpanel" aria-labelledby="admin-login-tab">
                    <form id="admin-login-form" action="./backend/login.php" method="POST">

                        <input type="hidden" name="role" value="admin"> <!-- Hidden field to identify role -->

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

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary login-btn">Login</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>