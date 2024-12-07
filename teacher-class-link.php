<!-- Class Links Section for Teachers -->
<div class="class-links-section">
    <h4 class="section-title">Manage Class Links</h4>

    <!-- Input Field for Class Link -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Add or Update Class Link</h5>
            <form action="save-class-link.php" method="POST">
                <div class="mb-3">
                    <label for="classLink" class="form-label">Class Link</label>
                    <input type="url" class="form-control" id="classLink" name="class_link" placeholder="Enter class link" required>
                </div>
                <button type="submit" class="btn btn-success">Save Link</button>
            </form>
        </div>
    </div>

    <!-- Display Current Class Link -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Current Class Link</h5>
            <p class="card-text">This is the latest saved class link that students can use to join the class.</p>
            <a href="<?php echo $currentClassLink; ?>" class="btn btn-primary">Join Current Class</a>
        </div>
    </div>
</div>