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
</head>
<body>

    <!-- Include Navbar -->
    <?php include 'header.php'; ?>

    <!-- Main Content for Course Explore Page -->
    <div class="container py-5">
        <h1 class="text-center mb-5">Explore Courses</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Course Card 1 -->
            <div class="col">
                <div class="card h-100 course-card">
                    <img src="images/course1.jpeg" class="card-img-top" alt="Course 1">
                    <div class="card-body">
                        <h5 class="card-title">Course Title 1</h5>
                        <p class="card-text">Learn the essentials of web development with this comprehensive course.</p>
                        <p class="course-meta">Level: Beginner | Duration: 10 weeks</p>
                        <a href="course.php" class="btn btn-primary">Enroll</a>
                    </div>
                </div>
            </div>
            <!-- Course Card 2 -->
            <div class="col">
                <div class="card h-100 course-card">
                    <img src="images/course2.jpg" class="card-img-top" alt="Course 2">
                    <div class="card-body">
                        <h5 class="card-title">Course Title 2</h5>
                        <p class="card-text">Master data science and machine learning in this hands-on course.</p>
                        <p class="course-meta">Level: Intermediate | Duration: 12 weeks</p>
                        <a href="course.php" class="btn btn-primary">Enroll</a>
                    </div>
                </div>
            </div>
            <!-- Course Card 3 -->
            <div class="col">
                <div class="card h-100 course-card">
                    <img src="images/course3.png" class="card-img-top" alt="Course 3">
                    <div class="card-body">
                        <h5 class="card-title">Course Title 3</h5>
                        <p class="card-text">Explore advanced Python programming techniques in this expert-level course.</p>
                        <p class="course-meta">Level: Advanced | Duration: 8 weeks</p>
                        <a href="course.php" class="btn btn-primary">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
