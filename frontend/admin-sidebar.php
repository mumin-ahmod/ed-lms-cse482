<!-- sidebar.php -->
<?php
    // Get the current page name
    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<aside class="student-dashboard-sidebar bg-light border-end shadow-sm" style="width: 250px;">
    <div class="p-4">
        <h4 class="sidebar-title">Admin Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == 'admin-course.php' ? 'active' : ''; ?> sidebar-link" href="admin-course.php">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == 'assign-teacher.php' ? 'active' : ''; ?> sidebar-link" href="assign-teacher.php">Assign Teachers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == 'change-role.php' ? 'active' : ''; ?> sidebar-link" href="change-role.php">Change Roles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $currentPage == 'admin-enrollments.php' ? 'active' : ''; ?> sidebar-link" href="admin-enrollments.php">Enrollments</a>
            </li>
            <!-- Add more links as necessary -->
        </ul>
    </div>
</aside>
