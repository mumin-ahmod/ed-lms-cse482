<!-- add-course.php -->
<?php
include '../backend/db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : NULL;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Set the target directory for image uploads
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['image']['name']);
        $target_file = $upload_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image
        if (in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $target_file; // Store the file path in the database
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "Only image files are allowed.";
            exit();
        }
    } else {
        $image_path = NULL; // If no image was uploaded
    }

    // Insert the course into the database
    $sql = "INSERT INTO Course (Title, Description, Start_date, End_date, Image) VALUES (:title, :description, :start_date, :end_date, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'description' => $description,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'image' => $image_path,
    ]);

    // Redirect to the courses page after adding
    header("Location: admin-course.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Add New Course</h2>
        <form action="add-course.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Course</button>
            <a href="admin-course.php" class="btn btn-secondary">Back to Courses</a>
        </form>
    </div>
</body>

</html>
