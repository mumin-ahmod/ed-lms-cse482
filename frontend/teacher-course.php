<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Timeline</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>


    <div class="container-fluid">
        <div class="row">

            <!-- Include Sidebar -->
            <?php include 'teacher-sidebar.php'; ?>
            <!-- Main Content -->
            <main class="course-timeline-main col bg-light">
                <div>
                    <h2 class="course-timeline-title">Course Timeline</h2>

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs mb-4" id="courseTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-people-tab" data-bs-toggle="tab" data-bs-target="#all-people" type="button" role="tab" aria-controls="all-people" aria-selected="true">All People</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="timeline-posts-tab" data-bs-toggle="tab" data-bs-target="#timeline-posts" type="button" role="tab" aria-controls="timeline-posts" aria-selected="false">Timeline Posts</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="class-links-tab" data-bs-toggle="tab" data-bs-target="#teacher-class-links" type="button" role="tab" aria-controls="teacher-class-links" aria-selected="false">Class Links</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="exams-tab" data-bs-toggle="tab" data-bs-target="#teacher-exams" type="button" role="tab" aria-controls="teacher-exams" aria-selected="false">Exams</button>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content" id="courseTabContent">
                        <!-- All People Tab -->
                        <div class="tab-pane fade show active" id="all-people" role="tabpanel" aria-labelledby="all-people-tab">
                            <?php include 'teacher-all-people.php'; ?>
                        </div>

                        <!-- Timeline Posts Tab -->
                        <div class="tab-pane fade" id="timeline-posts" role="tabpanel" aria-labelledby="timeline-posts-tab">
                            <?php include 'timeline_posts.php'; ?>
                        </div>

                        <!-- Class Links Tab -->
                        <div class="tab-pane fade" id="teacher-class-links" role="tabpanel" aria-labelledby="class-links-tab">
                            <?php include 'teacher-class-link.php'; ?>
                        </div>

                        <!-- Exams Tab -->
                        <div class="tab-pane fade" id="teacher-exams" role="tabpanel" aria-labelledby="exams-tab">
                            <?php include 'teacher-exam.php'; ?>
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