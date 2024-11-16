<?php
// Include the database connection
require_once '../backend/db.php'; // Adjust the path if db.php is in the root directory

// Fetch all courses from the database (moved to AJAX)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        <div class="row row-cols-1 row-cols-md-3 g-4" id="courseContainer">
            <p class="text-center" id="noCoursesMessage">Loading courses...</p>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch courses from the server via AJAX
            fetchCoursesFromServer();
        });

        function fetchCoursesFromServer() {
            // AJAX request to fetch courses from PHP
            $.ajax({
                url: '../backend/fetch-courses.php', // PHP script to fetch courses
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // If data is available, display it
                    if (data.length > 0) {
                        displayCourses(data);
                    } else {
                        document.getElementById("courseContainer").innerHTML = "<p class='text-center'>No courses available at the moment.</p>";
                    }
                },
                error: function() {
                    console.error('Error fetching courses from server.');
                    document.getElementById("courseContainer").innerHTML = "<p class='text-center'>Error loading courses. Please try again later.</p>";
                }
            });
        }

        function displayCourses(courses) {
            const courseContainer = document.getElementById("courseContainer");
            courseContainer.innerHTML = ""; // Clear loading message or previous content

            courses.forEach(course => {
                const courseCard = `
                    <div class="col">
                        <div class="card h-100 course-card">
                            <img src="../images/${course.Image}" class="card-img-top" alt="${course.Title}">
                            <div class="card-body">
                                <h5 class="card-title">${course.Title}</h5>
                                <p class="card-text">${course.Description}</p>
                                <p class="course-meta">Start Date: ${course.Start_date}</p>
                                ${course.End_date ? `<p class="course-meta">End Date: ${course.End_date}</p>` : ""}
                                <a href="course.php?id=${course.Id}" class="btn btn-primary">Enroll</a>
                            </div>
                        </div>
                    </div>
                `;
                courseContainer.innerHTML += courseCard;
            });
        }
    </script>
</body>

</html>