<header>
    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm py-3">
        <div class="container-fluid">
            <!-- Brand Name with Icon -->
            <a class="navbar-brand d-flex align-items-center" href="./home.php">
                <img src="images/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./explore.php">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./aboutus.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.php">Contact</a>
                    </li>
                </ul>

                <!-- Search Form with FontAwesome Icon -->
                <form class="d-flex align-items-center ms-3">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                    <a href="" class="btn btn-sm btn-outline-light align-items-center">  <i class="fa fa-search"></i></a>
                </form>

                <!-- Profile Link with Icon -->
                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="./dashboard.php">
                            <i class="fa fa-user me-1"></i> Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
