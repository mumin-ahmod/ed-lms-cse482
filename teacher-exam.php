<!-- Exams Section for Teachers -->
<div class="exams-section">
    <h4 class="section-title">Manage Exams</h4>

    <!-- Button to Create New Exam -->
    <div class="mb-3">
        <a href="create-exam.php" class="btn btn-success">Create New Exam</a>
    </div>

    <!-- List of Existing Exams -->
    <!-- Loop through the exams for the course and display each one as a card -->
    <!-- Example Exam 1 -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Exam Title 1</h5>
            <p class="card-text">Details about the exam, including the date, time, and subjects covered.</p>
            <p class="card-text"><small class="text-muted">Scheduled for October 5, 2024</small></p>
            <a href="edit-exam.php?id=1" class="btn btn-primary btn-sm">Edit Exam</a>
            <a href="delete-exam.php?id=1" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this exam?')">Delete Exam</a>
        </div>
    </div>

    <!-- Example Exam 2 -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Exam Title 2</h5>
            <p class="card-text">Information regarding this exam. Important instructions may be provided here.</p>
            <p class="card-text"><small class="text-muted">Scheduled for October 12, 2024</small></p>
            <a href="edit-exam.php?id=2" class="btn btn-primary btn-sm">Edit Exam</a>
            <a href="delete-exam.php?id=2" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this exam?')">Delete Exam</a>
        </div>
    </div>

    <!-- Add more exam cards dynamically -->
</div>
