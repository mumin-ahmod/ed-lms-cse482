<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            <main class="student-dashboard-content col bg-white mt-5" style="margin-left: 250px;">
                <div class="p-3">


                    <h2>Welcome To Admin Panel </h2>
                    <h4>From this admin panel we can handle the teacher and student issue.....</h4>

                </div>
            </main>
        </div>
    </div>

    <script src="path/to/bootstrap.bundle.min.js"></script>
</body>

</html>
