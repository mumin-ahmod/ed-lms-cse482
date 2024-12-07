<?php
// Include the database connection
include '../backend/db.php';

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if course_id is provided
if (!isset($_GET['course_id']) || empty($_GET['course_id'])) {
    die("Course ID is required.");
}

$course_id = intval($_GET['course_id']);

// Fetch course name
try {
    $course_query = "SELECT Title FROM course WHERE id = ?";
    $course_stmt = $pdo->prepare($course_query);
    $course_stmt->execute([$course_id]);
    $course = $course_stmt->fetch();

    if (!$course) {
        die("Course not found.");
    }

    $course_name = $course['Title'];
} catch (Exception $e) {
    die("Error fetching course: " . $e->getMessage());
}

// Fetch all exams for this course
try {
    $exam_query = "SELECT * FROM exams WHERE course_id = ? ORDER BY start_date ASC, start_time ASC";
    $exam_stmt = $pdo->prepare($exam_query);
    $exam_stmt->execute([$course_id]);
    $exams = $exam_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error fetching exams: " . $e->getMessage());
}

// Get current page name for sidebar active state
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exams - <?php echo htmlspecialchars($course_name); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include __DIR__ . '/header.php'; ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <aside class="teacher-dashboard-sidebar bg-light border-end shadow-sm" style="width: 250px;">
                <div class="p-4">
                    <h4 class="sidebar-title">Teacher Dashboard</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentPage == 'teacher-dashboard.php' ? 'active' : ''; ?> sidebar-link" href="teacher-dashboard.php">My Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentPage == 'blog-index.php' ? 'active' : ''; ?> sidebar-link" href="blog-index.php">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentPage == 'teacher-exam.php' ? 'active' : ''; ?> sidebar-link" href="teacher-exam.php">Exams</a>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="col-md-9">
                <!-- Exams Section for Teachers -->
                <div class="exams-section p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Exams for <?php echo htmlspecialchars($course_name); ?></h2>
                        <!-- Button to Create New Exam -->
                        <a href="create-exam.php?course_id=<?php echo $course_id; ?>" class="btn btn-success">
                            <i class="fa fa-plus"></i> Create New Exam
                        </a>
                    </div>

                    <!-- List of Existing Exams -->
                    <?php if (empty($exams)): ?>
                        <div class="alert alert-info">
                            No exams have been created for this course yet.
                        </div>
                    <?php else: ?>
                        <?php foreach ($exams as $exam): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($exam['title']); ?></h5>
                                    <p class="card-text">
                                        <strong>Date:</strong> <?php echo date('F j, Y', strtotime($exam['start_date'])); ?><br>
                                        <strong>Time:</strong> <?php echo date('g:i A', strtotime($exam['start_time'])); ?>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            Status:
                                            <span class="badge <?php echo $exam['status'] ? 'bg-success' : 'bg-secondary'; ?>">
                                                <?php echo $exam['status'] ?>
                                            </span>
                                        </small>
                                    </p>

                                    <div class="btn-group">
                                        <a href="edit-exam.php?id=<?php echo $exam['id']; ?>&course_id=<?php echo $course_id; ?>"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="delete-exam.php?id=<?php echo $exam['id']; ?>&course_id=<?php echo $course_id; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this exam?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                        <form method="POST" action="../backend/toggle-exam-status.php" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($exam['id']); ?>">
                                            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">
                                            <button type="submit"
                                                class="btn <?php echo $exam['status'] === 'unpublished' ? 'btn-success' : 'btn-secondary'; ?> btn-sm">
                                                <i class="fa fa-toggle-on"></i>
                                                <?php echo $exam['status'] === 'unpublished' ? 'Publish' : 'Unpublish'; ?>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>