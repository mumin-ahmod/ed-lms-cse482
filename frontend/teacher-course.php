<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Timeline</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'teacher-sidebar.php'; ?>

            <!-- Main Content -->
            <main class="course-timeline-main col bg-light">
                <div>
                    <h2 class="course-timeline-title">Course Details</h2>

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs mb-4" id="courseTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="add-students-tab" data-bs-toggle="tab" data-bs-target="#add-students" type="button" role="tab" aria-controls="add-students" aria-selected="true">Add Students to Course</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="timeline-posts-tab" data-bs-toggle="tab" data-bs-target="#timeline-posts" type="button" role="tab" aria-controls="timeline-posts" aria-selected="false">Timeline Posts</button>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content" id="courseTabContent">
                        <!-- Add Students to Course Tab -->
                        <div class="tab-pane fade show active" id="add-students" role="tabpanel" aria-labelledby="add-students-tab">
                            <!-- Form to Add Student to Course -->
                            <form action="../backend/add-student-to-course.php" method="POST">
                                <div class="mb-3">
                                    <label for="student" class="form-label">Select Student</label>
                                    <select class="form-select" id="student" name="user_id" required>
                                        <option value="">Choose a student</option>
                                        <?php
                                        // Include DB connection
                                        include '../backend/db.php';
                                        // Get all students
                                        $sql = "SELECT Id, Name FROM users WHERE role = 'student'";
                                        $stmt = $pdo->query($sql);

                                        // Populate dropdown with students
                                        while ($student = $stmt->fetch()) {
                                            echo "<option value='" . htmlspecialchars($student['Id']) . "'>" . htmlspecialchars($student['Name']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Hidden field to store course_id -->
                                <input type="hidden" name="course_id" value="<?php echo isset($_GET['course_id']) ? htmlspecialchars($_GET['course_id']) : ''; ?>">

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Add Student</button>
                            </form>

                            <!-- Display List of Students Added to the Course -->
                            <h3 class="mt-4">Students in this Course</h3>
                            <?php
                            if (isset($_GET['course_id'])) {
                                $course_id = $_GET['course_id'];

                                // Fetch students assigned to this course
                                $sql = "SELECT u.Id, u.Name FROM users u
                                        JOIN course_enrollments ce ON u.Id = ce.user_id
                                        WHERE ce.course_id = :course_id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(['course_id' => $course_id]);

                                if ($stmt->rowCount() > 0) {
                                    echo "<table class='table table-striped'>";
                                    echo "<thead><tr><th>#</th><th>Student Name</th></tr></thead><tbody>";
                                    while ($student = $stmt->fetch()) {
                                        echo "<tr><td>" . htmlspecialchars($student['Id']) . "</td><td>" . htmlspecialchars($student['Name']) . "</td></tr>";
                                    }
                                    echo "</tbody></table>";
                                } else {
                                    echo "<p>No students enrolled in this course yet.</p>";
                                }
                            }
                            ?>
                        </div>

                        <!-- Timeline Posts Tab -->
                        <div class="tab-pane fade" id="timeline-posts" role="tabpanel" aria-labelledby="timeline-posts-tab">
                            <?php include 'timeline_posts.php'; ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>