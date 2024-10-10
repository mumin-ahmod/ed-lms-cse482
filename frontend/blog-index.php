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

    <!-- Include Navbar -->
    <?php include 'header.php'; ?>


<!-- Blogs Index Page -->
<div class="blogs-index-page">
    <h4 class="section-title">My Blogs</h4>

    <!-- Button to Post a New Blog -->
    <div class="mb-3">
        <a href="create-blog.php" class="btn btn-success">
            <i class="fas fa-plus"></i> Post a Blog
        </a>
    </div>

    <!-- Blog 1 Example -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Blog Title 1</h5>
            <p class="card-text">This is a brief content of the first blog post. You can write more details here.</p>
            <p class="card-text"><small class="text-muted">Posted on September 30, 2024</small></p>
            <div class="action-buttons">
                <a href="edit-blog.php?id=1" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="delete-blog.php?id=1" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog?')">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </div>
        </div>
    </div>

    <!-- Blog 2 Example -->
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Blog Title 2</h5>
            <p class="card-text">This is a brief content of the second blog post. You can add more details here.</p>
            <p class="card-text"><small class="text-muted">Posted on October 1, 2024</small></p>
            <div class="action-buttons">
                <a href="edit-blog.php?id=2" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="delete-blog.php?id=2" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog?')">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </div>
        </div>
    </div>

    <!-- Add more blogs dynamically -->
</div>
    
</body>
