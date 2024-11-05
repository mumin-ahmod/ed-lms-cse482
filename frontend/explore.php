<?php
// Include the database connection
require_once '../backend/db.php'; // Adjust the path if db.php is in the root directory

try {
    // Fetch all courses from the database
    $sql = "SELECT * FROM course";
    $stmt = $pdo->query($sql);
    $courses = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Courses</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Add this in the head section of explore.php -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <!-- Include Navbar -->
    <?php include 'header.php'; ?>

    <!-- Main Content for Course Explore Page -->
    <div class="container py-5">
        <h1 class="text-center mb-5">Explore Courses</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (!empty($courses)) : ?>
                <?php foreach ($courses as $course) : ?>
                    <div class="col">
                        <div class="card h-100 course-card">
                            <img src="../images/<?php echo htmlspecialchars($course['Image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($course['Title']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($course['Title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($course['Description']); ?></p>
                                <p class="course-meta">Start Date: <?php echo htmlspecialchars($course['Start_date']); ?></p>
                                <?php if (!empty($course['End_date'])): ?>
                                    <p class="course-meta">End Date: <?php echo htmlspecialchars($course['End_date']); ?></p>
                                <?php endif; ?>
                                <a href="course.php?id=<?php echo htmlspecialchars($course['Id']); ?>" class="btn btn-primary">Enroll</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">No courses available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <div id="test"></div>

    <script src="../frontend/script.js"></script>
    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>