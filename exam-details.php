<?php
// Include your database connection file
include '../backend/db.php';  // Make sure this path is correct

// Initialize the exams variable
$exams = [];

try {
    // Fetch data from the 'exam' table
    $sql = "SELECT * FROM exams";  // Adjust the table name if needed
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all the records
    $exams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If no data is fetched
    if (!$exams) {
        echo "No exams found.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header (optional, if you want to include a site-wide header) -->
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h2>Exam Details</h2>

        <!-- Exam Details Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Exam ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Course ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are exams to display
                if (!empty($exams)) {
                    // Loop through the results and display each row
                    foreach ($exams as $exam) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($exam['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($exam['user_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($exam['course_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($exam['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($exam['start_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($exam['start_time']) . "</td>";
                        echo "<td>" . htmlspecialchars($exam['status']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No exams available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>