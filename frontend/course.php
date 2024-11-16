<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Timeline</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>
    <!-- Include Sidebar -->
    <?php include 'sidebar.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main class="course-timeline-main col bg-light" style="margin-left: 250px;">
                <div class="p-4">
                    <h2 class="course-timeline-title">Course Timeline</h2>

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs mb-4" id="courseTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-people-tab" data-bs-toggle="tab" data-bs-target="#all-people" type="button" role="tab" aria-controls="all-people" aria-selected="true">All People</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="timeline-posts-tab" data-bs-toggle="tab" data-bs-target="#timeline-posts" type="button" role="tab" aria-controls="timeline-posts" aria-selected="false">Timeline Posts</button>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content" id="courseTabContent">
                        <!-- All People Tab -->
                        <div class="tab-pane fade show active" id="all-people" role="tabpanel" aria-labelledby="all-people-tab">
                            <?php include 'all_people.php'; ?>
                        </div>
                        <!-- Timeline Posts Tab -->
                        <div class="tab-pane fade" id="timeline-posts" role="tabpanel" aria-labelledby="timeline-posts-tab">
                            <?php include 'timeline_posts.php'; ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS if needed -->
    <script>
        // Optional: Activate the correct tab based on URL hash
        const triggerTabList = [].slice.call(document.querySelectorAll('#courseTab button'))
        triggerTabList.forEach(function(triggerEl) {
            const tabTrigger = new bootstrap.Tab(triggerEl)
            if (window.location.hash === triggerEl.dataset.bsTarget) {
                tabTrigger.show()
            }
            triggerEl.addEventListener('click', function(event) {
                event.preventDefault()
                window.location.hash = triggerEl.dataset.bsTarget
            })
        })
    </script>
</body>

</html>