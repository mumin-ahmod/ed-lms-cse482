<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header (optional, if you want to include a site-wide header) -->
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Create New Post</h2>
            <!-- Button to My All Posts -->
            <a href="my-all-posts.php" class="btn btn-primary">
                <i class="bi bi-card-list"></i> My All Posts
            </a>
        </div>

        <!-- Post Creation Form -->
        <form action="../backend/submit-post.php" method="POST">
            <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($_GET['id']); ?>">

            <div class="mb-3">
                <label for="postTitle" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="postTitle" name="postTitle" required>
            </div>

            <div class="mb-3">
                <label for="postContent" class="form-label">Post Content</label>
                <textarea class="form-control" id="postContent" name="postContent" rows="6" required></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">
                <i class="bi bi-upload"></i> Submit Post
            </button>
        </form>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>