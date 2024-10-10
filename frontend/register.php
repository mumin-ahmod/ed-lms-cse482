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
        /* Custom styles for unique classes */
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .submit-btn {
            width: 100%;
            margin-top: 15px;
        }
        .role-dropdown {
            width: 100%;
        }
    </style>
</head>
<body>


    <!-- Include Navbar -->
    <?php include 'header.php'; ?>

<div class="container">
    <div class="form-container">
        <h2 class="form-title">Register</h2>

        <!-- Form -->
        <form id="form-courses-website" action="backend/register.php" method="POST">


            <!-- Name -->
            <div class="mb-3">
                <label for="name-field" class="form-label">Name</label>
                <input type="text" class="form-control" id="name-field" name="name" placeholder="Enter your name" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email-field" class="form-label">Email</label>
                <input type="email" class="form-control" id="email-field" name="email" placeholder="Enter your email" required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone-field" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone-field" name="phone" placeholder="Enter your phone number" required>
            </div>

            <!-- Role Dropdown -->
            <div class="mb-3">
                <label for="role-field" class="form-label">Role</label>
                <select class="form-select role-dropdown" id="role-field" name="role" required>
                    <option value="">Select your role</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary submit-btn" id="submit-btn">Submit</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
