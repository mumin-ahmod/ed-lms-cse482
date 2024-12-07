<?php
// Include necessary files
require_once '../backend/db.php'; // Adjust path if needed
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    // Fetch enrolled courses for the logged-in user
    $sql = "
        SELECT course.Id, course.Title, course.Description, course.Start_date, course.End_date 
        FROM students 
        JOIN course ON students.course_id = course.Id 
        WHERE students.user_id = :user_id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $enrolledCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $error = "Failed to load courses. Please try again later.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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

                    <?php if (isset($error)) : ?>
                        <p class="text-danger"><?php echo $error; ?></p>
                    <?php elseif (empty($enrolledCourses)) : ?>
                        <p class="text-center">You are not enrolled in any courses yet.</p>
                    <?php else : ?>
                        <div class="row">
                            <?php foreach ($enrolledCourses as $course) : ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card border-primary">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($course['Title']); ?></h5>
                                            <p class="card-text"><?php echo htmlspecialchars($course['Description']); ?></p>
                                            <p class="card-text">Start Date: <?php echo htmlspecialchars($course['Start_date']); ?></p>
                                            <?php if ($course['End_date']) : ?>
                                                <p class="card-text">End Date: <?php echo htmlspecialchars($course['End_date']); ?></p>
                                            <?php endif; ?>
                                            <a href="course.php?id=<?php echo $course['Id']; ?>" class="btn btn-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>