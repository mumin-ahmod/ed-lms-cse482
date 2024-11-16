<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'admin-sidebar.php'; ?>
            <main class="admin-dashboard-content col bg-white mt-5" style="margin-left: 250px;">
                <div class="p-3">
                    <h2>Assign Teacher to Course</h2>
                    <form action="../backend/assign-teacher-handler.php" method="POST">
                        <div class="mb-3">
                            <label for="course" class="form-label">Select Course</label>
                            <select class="form-select" id="course" name="course_id" required>
                                <option value="">Choose a course</option>
                                <?php
                                include '../backend/db.php';
                                $sql = "SELECT Id, Title FROM Course";
                                $stmt = $pdo->query($sql);
                                while ($course = $stmt->fetch()) {
                                    echo "<option value='" . htmlspecialchars($course['Id']) . "'>" . htmlspecialchars($course['Title']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="teacher" class="form-label">Select Teacher</label>
                            <select class="form-select" id="teacher" name="user_id" required>
                                <option value="">Choose a teacher</option>
                                <?php
                                $sql = "SELECT Id, Name FROM users WHERE role = 'teacher'";
                                $stmt = $pdo->query($sql);
                                while ($teacher = $stmt->fetch()) {
                                    echo "<option value='" . htmlspecialchars($teacher['Id']) . "'>" . htmlspecialchars($teacher['Name']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Assign Teacher</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>