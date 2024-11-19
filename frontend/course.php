<?php
// Include necessary files
require_once '../backend/db.php'; // Adjust the path to your db.php
session_start();

// Get the course ID from the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Course ID is required.");
}

$courseId = intval($_GET['id']);
$course = null;
$enrolledUsers = [];

try {
    // Fetch course details
    $courseQuery = "SELECT Title FROM course WHERE Id = :courseId";
    $stmt = $pdo->prepare($courseQuery);
    $stmt->execute(['courseId' => $courseId]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$course) {
        die("Course not found.");
    }

    // Fetch enrolled users
    $enrolledQuery = "
        SELECT users.name, users.email 
        FROM students 
        JOIN users ON students.user_id = users.id 
        WHERE students.course_id = :courseId
    ";
    $stmt = $pdo->prepare($enrolledQuery);
    $stmt->execute(['courseId' => $courseId]);
    $enrolledUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("An error occurred while fetching data: " . $e->getMessage());
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['Title']); ?> - Course Timeline</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>
    <!-- Include Sidebar -->
    <?php include 'sidebar.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main class="course-timeline-main col bg-light" style="margin-left: 250px;">
                <div class="p-4">
                    <!-- Course Title -->
                    <h2 class="course-timeline-title"><?php echo htmlspecialchars($course['Title']); ?></h2>

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs mb-4" id="courseTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-people-tab" data-bs-toggle="tab" data-bs-target="#all-people" type="button" role="tab" aria-controls="all-people" aria-selected="true">All People</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="timeline-posts-tab" data-bs-toggle="tab" data-bs-target="#timeline-posts" type="button" role="tab" aria-controls="timeline-posts" aria-selected="false">Timeline Posts</button>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content" id="courseTabContent">
                        <!-- All People Tab -->
                        <div class="tab-pane fade show active" id="all-people" role="tabpanel" aria-labelledby="all-people-tab">
                            <h4>Enrolled Students</h4>
                            <?php if (empty($enrolledUsers)) : ?>
                                <p>No students are enrolled in this course.</p>
                            <?php else : ?>
                                <ul class="list-group">
                                    <?php foreach ($enrolledUsers as $user) : ?>
                                        <li class="list-group-item">
                                            <strong><?php echo htmlspecialchars($user['name']); ?></strong> 
                                            (<a href="mailto:<?php echo htmlspecialchars($user['email']); ?>"><?php echo htmlspecialchars($user['email']); ?></a>)
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
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
