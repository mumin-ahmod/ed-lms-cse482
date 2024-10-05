<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Role</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'admin-sidebar.php'; ?>

            <!-- Main Content -->
            <main class="admin-dashboard-content col bg-white mt-5" style="margin-left: 250px;">
                <div class="p-3">
                    <h2>Change User Roles</h2>
                    
                    <!-- User List Table -->
                    <table class="table table-bordered table-hover mt-4">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Sample users array (Replace this with database query to fetch users)
                            $users = [
                                ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'student'],
                                ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'teacher'],
                                ['id' => 3, 'name' => 'Mike Johnson', 'email' => 'mike@example.com', 'role' => 'student']
                            ];

                            // Loop through users and display in the table
                            foreach ($users as $user) {
                                echo "<tr>
                                    <td>{$user['id']}</td>
                                    <td>{$user['name']}</td>
                                    <td>{$user['email']}</td>
                                    <td>{$user['role']}</td>
                                    <td>
                                        <a href='change-role-handler.php?user_id={$user['id']}&role=teacher' class='btn btn-sm btn-warning me-2'>Make Teacher</a>
                                        <a href='change-role-handler.php?user_id={$user['id']}&role=admin' class='btn btn-sm btn-primary'>Make Admin</a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="path/to/bootstrap.bundle.min.js"></script>
</body>
</html>
