<?php
session_start(); // Start the session to access session variables
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'teacher-sidebar.php'; ?>
            <div class="col-md-9">
                <main class="course-timeline-main bg-light mt-5">
                    <div class="p-4">
                        <h2>My Courses</h2>
                        <div class="row">
                            <?php
                            include '../backend/db.php';

                            // Check if the session is set for user_id
                            if (isset($_SESSION['user_id'])) {
                                $user_id = $_SESSION['user_id']; // Get user_id from session

                                // Query to fetch courses assigned to the teacher from the 'teachers' table
                                $sql = "SELECT c.Title, c.Start_date 
                                        FROM Course c
                                        JOIN teachers t ON c.Id = t.course_id
                                        WHERE t.user_id = :user_id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(['user_id' => $user_id]);

                                // Check if courses are found and display them
                                if ($stmt->rowCount() > 0) {
                                    while ($course = $stmt->fetch()) {
                                        echo "<div class='col-md-4 mb-4'>
                                                <div class='card border-primary'>
                                                    <div class='card-body'>
                                                        <h5 class='card-title'>" . htmlspecialchars($course['Title']) . "</h5>
                                                        <p class='card-text'>" . htmlspecialchars($course['Start_date']) . "</p>
                                                        <a href='teacher-course.php' class='btn btn-primary'>View Details</a>
                                                    </div>
                                                </div>
                                              </div>";
                                    }
                                } else {
                                    echo "<p>No courses found for this teacher.</p>";
                                }
                            } else {
                                echo "<p>Please log in to view your courses.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>