<?php
// Include necessary files and start the session
require_once '../backend/db.php'; // Adjust the path to your db.php
session_start();

// Get the course ID from the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Course ID is required.");
}

$courseId = intval($_GET['id']);
$course = null;
$enrolledUsers = [];
$timelinePosts = [];

// Fetch course details
try {
    // Fetch course details from the database
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

    // Fetch timeline posts for the course
    $postsQuery = "
        SELECT title, description, created_at 
        FROM timeline_posts 
        WHERE course_id = :courseId 
        ORDER BY created_at DESC
    ";
    $stmt = $pdo->prepare($postsQuery);
    $stmt->execute(['courseId' => $courseId]);
    $timelinePosts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("An error occurred while fetching data: " . $e->getMessage());
}

// Fetch all students for the dropdown
$students = [];
$sql = "SELECT Id, Name FROM users WHERE role = 'student'";
$stmt = $pdo->query($sql);
while ($student = $stmt->fetch()) {
    $students[] = $student;
}
?>

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
                    <h1><?php echo htmlspecialchars($course['Title']); ?></h1>
                    <h2 class="course-timeline-title">Course Details</h2>

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs mb-4" id="courseTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="add-students-tab" data-bs-toggle="tab" data-bs-target="#add-students" type="button" role="tab" aria-controls="add-students" aria-selected="true">Add Students to Course</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="timeline-posts-tab" data-bs-toggle="tab" data-bs-target="#timeline-posts" type="button" role="tab" aria-controls="timeline-posts" aria-selected="false">Timeline Posts</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="exams-tab" data-bs-toggle="tab" data-bs-target="#exams" type="button" role="tab" aria-controls="exams" aria-selected="false">Exams</button>
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
                                        <?php foreach ($students as $student): ?>
                                            <option value="<?php echo htmlspecialchars($student['Id']); ?>"><?php echo htmlspecialchars($student['Name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Hidden field to store course_id -->
                                <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($courseId); ?>">

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Add Student</button>
                            </form>

                            <!-- Display List of Students Added to the Course -->
                            <h3 class="mt-4">Students in this Course</h3>
                            <?php if (empty($enrolledUsers)): ?>
                                <p>No students enrolled in this course yet.</p>
                            <?php else: ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($enrolledUsers as $user): ?>
                                            <tr>


                                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>

                        <!-- Timeline Posts Tab -->
                        <div class="tab-pane fade" id="timeline-posts" role="tabpanel" aria-labelledby="timeline-posts-tab">
                            <!-- Timeline Posts Section -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="section-title">Timeline Posts</h4>
                                <!-- Post Button with Icon -->
                                <a href="timeline_post_create.php?id=<?php echo $courseId; ?>" class="btn btn-primary">Post</a>
                            </div>

                            <!-- Display Timeline Posts -->
                            <?php if (empty($timelinePosts)): ?>
                                <p>No posts available for this course.</p>
                            <?php else: ?>
                                <?php foreach ($timelinePosts as $post): ?>
                                    <div class="card mb-3 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                                            <p class="card-text"><?php echo htmlspecialchars($post['description']); ?></p>
                                            <p class="card-text"><small class="text-muted">Posted on <?php echo date("F j, Y", strtotime($post['created_at'])); ?></small></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <div class="tab-content" id="courseTabContent">
                            <!-- Add Students to Course Tab -->
                            <div class="tab-pane fade show active" id="add-students" role="tabpanel" aria-labelledby="add-students-tab">
                                <!-- Existing Add Students Content -->
                            </div>

                            <!-- Timeline Posts Tab -->
                            <div class="tab-pane fade" id="timeline-posts" role="tabpanel" aria-labelledby="timeline-posts-tab">
                                <!-- Existing Timeline Posts Content -->
                            </div>

                            <!-- Exams Tab -->
                            <div class="tab-pane fade" id="exams" role="tabpanel" aria-labelledby="exams-tab">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="section-title">Exams</h4>
                                    <a href="create-exam.php?course_id=<?php echo $courseId; ?>" class="btn btn-success">Create New Exam</a>
                                </div>

                                <!-- Fetch and Display Exams -->
                                <?php
                                // Fetch exams for the current course
                                $examsQuery = "SELECT id, title, start_date, start_time FROM exams WHERE course_id = :courseId ORDER BY start_date ASC, start_time ASC";
                                $stmt = $pdo->prepare($examsQuery);
                                $stmt->execute(['courseId' => $courseId]);
                                $exams = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if (empty($exams)): ?>
                                    <p>No exams scheduled for this course.</p>
                                <?php else: ?>
                                    <ul class="list-group">
                                        <?php foreach ($exams as $exam): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="mb-1"><?php echo htmlspecialchars($exam['title']); ?></h5>
                                                    <small>Scheduled: <?php echo htmlspecialchars($exam['start_date']); ?> at <?php echo htmlspecialchars($exam['start_time']); ?></small>
                                                </div>
                                                <div>
                                                    <a href="edit-exam.php?id=<?php echo $exam['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="delete-exam.php?id=<?php echo $exam['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this exam?')">Delete</a>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
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