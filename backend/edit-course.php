<!-- edit-course.php -->
<?php
include 'db.php'; // Include the database connection file

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $courseId = $_GET['id'];

    // Fetch the course data from the database for the provided ID
    $sql = "SELECT * FROM Course WHERE Id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $courseId]);
    $course = $stmt->fetch();

    if (!$course) {
        echo "Course not found.";
        exit();
    }
} else {
    echo "Invalid course ID.";
    exit();
}

// Handle form submission for updating the course
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : NULL;
    $image = $_POST['image'];

    // Update the course in the database
    $sql = "UPDATE Course SET Title = :title, Description = :description, Start_date = :start_date, End_date = :end_date, Image = :image WHERE Id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'description' => $description,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'image' => $image,
        'id' => $courseId
    ]);

    // Redirect back to the admin courses page
    header("Location: ../frontend/admin-course.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Course</h2>
        <form action="edit-course.php?id=<?php echo $courseId; ?>" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($course['Title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($course['Description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo htmlspecialchars($course['Start_date']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo htmlspecialchars($course['End_date']); ?>">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" class="form-control" id="image" name="image" value="<?php echo htmlspecialchars($course['Image']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Course</button>
            <a href="../admin-course.php" class="btn btn-secondary">Back to Courses</a>
        </form>
    </div>
</body>

</html>