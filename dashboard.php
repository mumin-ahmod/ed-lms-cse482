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
</head>
<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Main Content -->
            <main class="student-dashboard-content col bg-white mt-5" style="margin-left: 250px;">
                <div class="p-3">
                    <h2>My Courses</h2>
                    <div class="row">
                        <!-- Course Card Example -->
                        <div class="col-md-4 mb-4">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Course Name</h5>
                                    <p class="card-text">Section: A</p>
                                    <p class="card-text">Class Time: 10:00 AM - 12:00 PM</p>
                                    <a href="course.php" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat Course Cards as Needed -->
                        <div class="col-md-4 mb-4">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Course Name</h5>
                                    <p class="card-text">Section: B</p>
                                    <p class="card-text">Class Time: 1:00 PM - 3:00 PM</p>
                                    <a href="course.php" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                        <!-- Add more course cards here -->
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="path/to/bootstrap.bundle.min.js"></script>
</body>
</html>
