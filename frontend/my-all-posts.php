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
        <h2 class="mb-4">My All Posts</h2>

        <!-- Posts Table -->
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content Preview</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Post 1 -->
                <tr>
                    <td>1</td>
                    <td>Introduction to Programming</td>
                    <td>This post covers the basics of programming, including...</td>
                    <td>
                        <a href="edit-post.php?id=1" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="delete-post.php?id=1" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">
                            <i class="bi bi-trash"></i> Delete
                        </a>
                    </td>
                </tr>

                <!-- Example Post 2 -->
                <tr>
                    <td>2</td>
                    <td>Advanced Algorithms</td>
                    <td>A deep dive into algorithmic design and complexity theory...</td>
                    <td>
                        <a href="edit-post.php?id=2" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="delete-post.php?id=2" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">
                            <i class="bi bi-trash"></i> Delete
                        </a>
                    </td>
                </tr>

                <!-- Repeat rows for more posts -->
                <!-- Add more post rows dynamically with PHP or a database query -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
