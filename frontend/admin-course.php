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
            <main class="admin-dashboard-content col bg-white mt-5" style="margin-left: 250px;">
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
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Include database connection
                            include '../backend/db.php';

                            // Fetch courses from the Course table
                            $sql = "SELECT * FROM Course";
                            $stmt = $pdo->query($sql);

                            // Display each course in a table row
                            while ($course = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($course['Id']) . "</td>";
                                echo "<td>" . htmlspecialchars($course['Title']) . "</td>";
                                echo "<td>" . htmlspecialchars($course['Description']) . "</td>";
                                echo "<td>" . htmlspecialchars($course['Start_date']) . "</td>";
                                echo "<td>" . ($course['End_date'] ? htmlspecialchars($course['End_date']) : "N/A") . "</td>";
                                echo "<td>
                                        <a href='edit-course.php?id=" . $course['Id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                                        <a href='delete-course.php?id=" . $course['Id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this course?\")'>Delete</a>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
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