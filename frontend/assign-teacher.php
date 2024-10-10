<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Teacher</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'admin-sidebar.php'; ?>

            <!-- Main Content -->
            <main class="admin-dashboard-content col bg-white mt-5" style="margin-left: 250px;">
                <div class="p-3">
                    <h2>Assign Teacher to Course</h2>
                    
                    <!-- Form to Assign Teacher -->
                    <form action="assign-teacher-handler.php" method="POST">
                        <div class="mb-3">
                            <label for="course" class="form-label">Select Course</label>
                            <select class="form-select" id="course" name="course_id" required>
                                <option value="">Choose a course</option>
                                <!-- Populate this dynamically with PHP -->
                                <option value="1">Math Course 1</option>
                                <option value="2">English  2</option>
                                <option value="3">Programming Intro</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="teacher" class="form-label">Select Teacher</label>
                            <select class="form-select" id="teacher" name="teacher_id" required>
                                <option value="">Choose a teacher</option>
                                <!-- Populate this dynamically with PHP -->
                                <option value="1">Karim Uddin</option>
                                <option value="2">Mahedi Hassan</option>
                                <option value="3">Teacher C</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Assign Teacher</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script src="path/to/bootstrap.bundle.min.js"></script>
</body>
</html>
