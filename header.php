<header>
    <!-- External Font: Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom shadow-sm py-3">
        <div class="container-fluid">
            <!-- Brand Name with Icon -->
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <img src="../images/logo.svg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                <span>ED LMS</span>
            </a>

            <!-- Toggler for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navbar Links aligned to the right -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="./dashboard.php">Dashboard</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="./explore.php">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./aboutus.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./chat.php">Chat</a>
                    </li>
                </ul>
                <!-- Search Form with FontAwesome Icon -->
                <script src="https://kit.fontawesome.com/dda0a04756.js" crossorigin="anonymous"></script>
                <div class="search-container" style="position: relative; display: inline-block; width: 100%; max-width: 250px;">
                    <form method="GET" action="explore.php">
                        <div class="input-group">
                            <input
                                class="form-control form-control-sm"
                                type="text"
                                name="query"
                                id="input_box"
                                autocomplete="off"
                                placeholder="Search">
                            <button
                                class="btn btn-sm btn-primary"
                                type="submit">
                                <i class="fa-solid fa-magnifying-glass" align-items-center></i>
                            </button>
                        </div>
                        <!-- Dropdown Suggestions -->
                        <div class="result-box" id="result-box">
                            <ul>
                                <li> <!-- Dynamically generated suggestions will be injected here --></li>
                            </ul>
                        </div>
                    </form>
                </div>
                <script src="../frontend/searchscript.js"></script>
                <!-- Profile Dropdown or Login Link -->
                <ul class="navbar-nav ms-3">
                    <?php if (isset($_SESSION['name'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user me-1"></i> <?php echo htmlspecialchars($_SESSION['name']); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="../backend/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="../index.php">
                                <i class="fa fa-user me-1"></i> Logout
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>