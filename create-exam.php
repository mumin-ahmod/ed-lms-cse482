<?php
// Include the database connection
include '../backend/db.php';

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

// For POST requests, use the course_id from the form
// For GET requests, use it from the URL
$course_id = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : null;
} else {
    $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : null;
}

// Validate course_id
if (!$course_id) {
    die("Course ID is required.");
}

// Fetch the course name using the course ID
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
    die("An error occurred while fetching the course name: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $start_date = $_POST['start_date'];
    $start_time = $_POST['start_time'];

    // Validate inputs
    if (empty($title) || empty($start_date) || empty($start_time)) {
        die("All fields are required.");
    }

    try {
       

        $insert_sql = "INSERT INTO exams (user_id, course_id, title, start_date, start_time) 
                      VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $pdo->prepare($insert_sql);
        $result = $insert_stmt->execute([
            $_SESSION['user_id'],
            $course_id,
            $title,
            $start_date,
            $start_time
        ]);

        if ($result) {
            // Redirect to the course exams page or dashboard
            header("Location: teacher-exam.php?course_id=".$course_id);
            exit();
        } else {
            die("Failed to insert exam record.");
        }
    } catch (Exception $e) {
        die("An error occurred while adding the exam: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Exam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'teacher-sidebar.php'; ?>
            <!-- Main Content -->
            <div class="col-md-9">
                <main class="course-timeline-main bg-light mt-5">
                    <div class="p-4">
                        <h2>Create New Exam</h2>
                        <form method="POST" action="create-exam.php?course_id=<?php echo htmlspecialchars($course_id); ?>">
                            <h2>Course: <?php echo htmlspecialchars($course_name); ?></h2>

                            <!-- Changed to hidden input -->
                            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>">

                            <div class="mb-3">
                                <label for="title" class="form-label">Exam Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" required>
                            </div>

                            <button type="submit" class="btn btn-success">Create Exam</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>