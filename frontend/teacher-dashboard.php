<?php
// Start the session
session_start();

// Include the database connection
require_once '../backend/db.php'; // Adjust the path to your db.php

// Initialize courses array
$courses = [];

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    try {
        // Query to fetch courses assigned to the teacher
        $sql = "SELECT c.Id, c.Title, c.Start_date 
                FROM Course c
                JOIN teachers t ON c.Id = t.course_id
                WHERE t.user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);

        // Fetch courses
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Error fetching courses: " . $e->getMessage());
    }
}
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
                            <?php if (count($courses) > 0) : ?>
                                <?php foreach ($courses as $course) : ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card border-primary">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo htmlspecialchars($course['Title']); ?></h5>
                                                <p class="card-text"><?php echo htmlspecialchars($course['Start_date']); ?></p>
                                                <a href="teacher-course.php?id=<?php echo htmlspecialchars($course['Id']); ?>" class="btn btn-primary">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>No courses found for this teacher.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
