<?php
// Get the current page name
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<aside class="teacher-dashboard-sidebar bg-light border-end shadow-sm" style="width: 250px;">
    <div class="p-4">
        <h4 class="sidebar-title">Teacher Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == 'teacher-dashboard.php' ? 'active' : ''; ?> sidebar-link" href="teacher-dashboard.php">My Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == 'blog-index.php' ? 'active' : ''; ?> sidebar-link" href="blog-index.php">Blogs</a>
            </li>

        </ul>
    </div>
</aside>