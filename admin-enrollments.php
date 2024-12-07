<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollments</title>
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
                    <h2>Manage Enrollments</h2>

                    <!-- Enrollment Table -->
                    <table class="table table-bordered table-hover mt-4">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Course Name</th>
                                <th>Payment Status</th>
                                <th>Enrollment Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>Web Development</td>
                                <td>Paid</td>
                                <td>Pending</td>
                                <td>
                                    <button class="btn btn-sm btn-success me-2">Accept</button>
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>Data Science</td>
                                <td>Unpaid</td>
                                <td>Accepted</td>
                                <td>
                                    <button class="btn btn-sm btn-success me-2" disabled>Accept</button>
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Mike Johnson</td>
                                <td>Graphic Design</td>
                                <td>Paid</td>
                                <td>Pending</td>
                                <td>
                                    <button class="btn btn-sm btn-success me-2">Accept</button>
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
