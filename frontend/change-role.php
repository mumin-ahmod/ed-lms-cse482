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
                            include '../backend/db.php'; // Adjust the path as needed

                            // Fetch all users from the database
                            $sql = "SELECT Id, Name, Email, Role FROM users";
                            $stmt = $pdo->query($sql);

                            // Loop through the fetched users and display them in the table
                            while ($user = $stmt->fetch()) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($user['Id']) . "</td>
                                    <td>" . htmlspecialchars($user['Name']) . "</td>
                                    <td>" . htmlspecialchars($user['Email']) . "</td>
                                    <td>" . htmlspecialchars($user['Role']) . "</td>
                                    <td>
                                        <a href='../backend/change-role-handler.php?user_id=" . htmlspecialchars($user['Id']) . "&role=teacher' class='btn btn-sm btn-warning me-2'>Make Teacher</a>
                                        <a href='../backend/change-role-handler.php?user_id=" . htmlspecialchars($user['Id']) . "&role=admin' class='btn btn-sm btn-primary me-2'>Make Admin</a>
                                        <a href='../backend/change-role-handler.php?user_id=" . htmlspecialchars($user['Id']) . "&role=student' class='btn btn-sm btn-success'>Make Student</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>