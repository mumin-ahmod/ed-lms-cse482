<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Redirect after 2 seconds if success message is shown
        window.onload = function() {
            const successMessage = document.getElementById("successMessage");
            if (successMessage) {
                setTimeout(function() {
                    window.location.href = "http://localhost:3000/frontend/blog-index.php"; // Redirect URL
                }, 2000); // Redirect after 2 seconds
            }
        };
    </script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full bg-gradient-to-r from-indigo-100 via-blue-100 to-indigo-200 rounded-lg shadow-xl p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create a New Blog Post</h1>

        <?php if (isset($_GET['success'])): ?>
            <div id="successMessage" class="mb-4 p-4 bg-green-200 text-green-800 rounded-lg shadow-md">
                <p>Blog post created successfully!</p>
            </div>
        <?php endif; ?>

        <?php if (!empty($_GET['errors'])): ?>
            <div class="mb-4 p-4 bg-red-200 text-red-800 rounded-lg shadow-md">
                <ul class="list-disc pl-5 space-y-2">
                    <?php foreach (explode(',', $_GET['errors']) as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="../backend/createblog.php">
            <div class="mb-5">
                <label for="title" class="block text-lg font-medium text-gray-700">Blog Title</label>
                <input type="text" id="title" name="title"
                    class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                    placeholder="Enter your blog title" required>
            </div>

            <div class="mb-5">
                <label for="content" class="block text-lg font-medium text-gray-700">Content</label>
                <textarea id="content" name="content" rows="6"
                    class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                    placeholder="Write your blog content here..." required></textarea>
            </div>

            <div class="mb-5">
                <label for="author" class="block text-lg font-medium text-gray-700">Author Name</label>
                <input type="text" id="author" name="author"
                    class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                    placeholder="Enter author's name" required>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-800 text-white rounded-md shadow-lg transform hover:scale-105 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                    Create Blog
                </button>
            </div>
        </form>
    </div>
</body>

</html>