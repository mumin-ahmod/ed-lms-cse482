<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Include Navbar -->
    <?php include 'header.php'; ?>

    <!-- Blogs Index Page -->
    <div class="container my-5">
        <h4 class="section-title text-center mb-4">My Blogs</h4>

        <!-- Button to Post a New Blog -->
        <div class="text-end mb-3">
            <a href="create-blog.php" class="btn btn-success">
                <i class="fas fa-plus"></i> Post a Blog
            </a>
        </div>

        <!-- Blogs List -->
        <div id="blogs-list">
            <?php
            include '../backend/db.php';

            try {
                // Fetch blogs from the database
                $stmt = $pdo->query("SELECT id, title, content, created_at FROM blogs ORDER BY created_at DESC");
                $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($blogs):
                    foreach ($blogs as $blog): ?>
                        <div class="card mb-3" id="blog-<?php echo $blog['id']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($blog['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($blog['content'], 0, 100)) . '...'; ?></p>
                                <p class="card-text"><small class="text-muted">Posted on <?php echo date('F j, Y', strtotime($blog['created_at'])); ?></small></p>
                                <div class="action-buttons">
                                    <button class="btn btn-primary btn-sm" onclick="openEditModal(<?php echo $blog['id']; ?>, '<?php echo htmlspecialchars($blog['title']); ?>', '<?php echo htmlspecialchars(addslashes($blog['content'])); ?>')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteBlog(<?php echo $blog['id']; ?>)">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">No blogs available. Be the first to post!</p>
            <?php endif;
            } catch (PDOException $e) {
                echo "<p class='text-danger text-center'>Error fetching blogs: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>

    <!-- Edit Blog Modal -->
    <div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBlogForm">
                        <input type="hidden" id="editBlogId">
                        <div class="mb-3">
                            <label for="editBlogTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editBlogTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="editBlogContent" class="form-label">Content</label>
                            <textarea class="form-control" id="editBlogContent" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AJAX Script -->
    <script>
        function openEditModal(id, title, content) {
            document.getElementById('editBlogId').value = id;
            document.getElementById('editBlogTitle').value = title;
            document.getElementById('editBlogContent').value = content;
            const editModal = new bootstrap.Modal(document.getElementById('editBlogModal'));
            editModal.show();
        }

        document.getElementById('editBlogForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const blogId = document.getElementById('editBlogId').value;
            const title = document.getElementById('editBlogTitle').value;
            const content = document.getElementById('editBlogContent').value;

            fetch('../backend/edit-blog.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: blogId,
                        title: title,
                        content: content
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const blogCard = document.getElementById(`blog-${blogId}`);
                        blogCard.querySelector('.card-title').innerText = title;
                        blogCard.querySelector('.card-text').innerText = content.substr(0, 100) + '...';
                        alert('Blog updated successfully!');
                    } else {
                        alert('Error updating blog: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred.');
                });
        });
    </script>
</body>

</html>