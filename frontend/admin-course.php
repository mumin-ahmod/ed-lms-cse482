<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Courses</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <!-- Include Sidebar -->
    <?php include 'admin-sidebar.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main class="admin-dashboard-content col bg-white mt-5" style="margin-left: 250px;"> <!-- Adjusted sidebar margin -->
                <div class="p-4">
                    <h2 class="mb-4">Manage Courses</h2>

                    <!-- Button to Add New Course -->
                    <div class="mb-3">
                        <a href="add-course.php" class="btn btn-success">Add New Course</a>
                    </div>

                    <!-- Courses Table -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>Teacher</th>
                                <th>Category</th>
                                <th>Start Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dummy Data Example -->
                            <tr>
                                <td>1</td>
                                <td>Introduction to Python</td>
                                <td>John Doe</td>
                                <td>Programming</td>
                                <td>2024-10-10</td>
                                <td>
                                    <a href="edit-course.php?id=1" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="delete-course.php?id=1" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Advanced Mathematics</td>
                                <td>Jane Smith</td>
                                <td>Mathematics</td>
                                <td>2024-11-01</td>
                                <td>
                                    <a href="edit-course.php?id=2" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="delete-course.php?id=2" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                                </td>
                            </tr>
                            <!-- Add more course rows dynamically with PHP -->
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
