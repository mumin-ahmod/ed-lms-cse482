<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="World Education's mission to help 1 million people secure jobs by 2030 through skill development programs in technical, soft skills, and career growth." />
    <meta name="author" content="World Education">
    <meta property="og:description" content="Empowering individuals with the necessary skills to thrive in the modern job market." />
    <meta property="og:image" content="../images/ourmission.png" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- Include Navbar -->
    <?php include 'header.php'; ?>

    <!-- Welcome Section -->
    <section class="welcome-section animate-fade-in">
        <div class="content">
            <h3>About Us with Short Story</h3>
            <h1>Welcome to World Education</h1>
            <p>We are one of the most prominent virtual platforms for providing academic, career, and skill development, as well as cultural flourishments through events, campaigns, courses, master classes, and real-time communication.</p>
        </div>
    </section>

    <!-- Slide Show -->
     <section class="slider-frame">
        <div class="slide-images">
            <div class="img-container">
                <img src="../images/slide1.jpg" loading="lazy">
            </div>
            <div class="img-container">
                <img src="../images/slide2.jpg" loading="lazy">
            </div>
            <div class="img-container">
                <img src="../images/slide3.jpg" loading="lazy">
            </div>
        </div>
     </section>

    <!-- Mission and Life at Company Section -->
    <section class="company-section">
        <div class="mission animate-slide-left">
            <img src="../images/ourmission.png" alt="Our Mission Image">
            <div class="mission-text">
                <h2>Our Mission</h2>
                <p>Our mission is to help 1 million people secure jobs by 2030. We are dedicated to empowering individuals with the knowledge and expertise needed to thrive in the dynamic job market. Through our programs, we aim to enhance technical skills and soft skills like creativity, critical thinking, and adaptability, creating a pool of highly skilled professionals.</p>
            </div>
        </div>
        <hr>
        <div class="life-at-company animate-slide-right">
            <div class="life-text">
                <h2>World Education</h2>
                <p>At World Education, we believe in fostering team collaboration, a balanced work culture, and a friendly environment. We are committed to creating a space where ideas thrive, innovation blossoms, and every team member feels valued and inspired.</p>
            </div>
            <img src="../images/lifeatcompany.png" alt="Life at Company Image">
        </div>
        <hr>
        <div class="our-services animate-slide-left">
            <img src="../images/customer-service.png" alt="Our Services" loading="lazy">
            <div class="services">
                <h2>Our Services</h2>
                <p>We provide a range of services including academic, career, and skill development programs. Our goal is to foster collaboration, balance work culture, and innovation.</p>
            </div>
        </div>
    </section>

    <!-- New Details Sections -->
    <section class="new-details-section">
        <!-- Section 1 -->
        <div class="detail animate-fade-in">
            <img src="../images/teamworkandcollaboration.jpg" alt="Teamwork Image" loading="lazy">
            <div class="detail-text">
                <h2>Teamwork and Collaboration</h2>
                <p>We emphasize the importance of teamwork and collaboration, encouraging our employees to share ideas and work together to achieve common goals.</p>
            </div>
        </div>
        <hr>
        <!-- Section 2 -->
        <div class="detail animate-slide-right">
            <img src="../images/innovation.jpg" alt="Innovation Image" loading="lazy">
            <div class="detail-text">
                <h2>Innovation at Its Core</h2>
                <p>Innovation drives our success. We foster a culture where creativity and new ideas are encouraged and rewarded.</p>
            </div>
        </div>
        <hr>
        <!-- Section 3 -->
        <div class="detail animate-slide-left">
            <img src="../images/communityimpact.jpg" alt="Community Impact Image" loading="lazy">
            <div class="detail-text">
                <h2>Community Impact</h2>
                <p>We are committed to positively impacting our community by organizing educational initiatives and supporting local development programs.</p>
            </div>
        </div>
        <hr>
        <!-- Section 4 -->
        <div class="detail animate-fade-in">
            <img src="../images/career-growth.jpg" alt="Career Growth Image">
            <div class="detail-text">
                <h2>Career Growth Opportunities</h2>
                <p>Our platform offers extensive career growth opportunities, helping individuals build their careers with industry-leading skills and certifications.</p>
            </div>
        </div>
    </section>

    <!-- Privacy Policy Section -->
    <section class="privacy-section animate-fade-in">
        <div class="content">
            <h2>Privacy Policy</h2>
            <p><strong>Effective Date:</strong> 2025</p>
            <p>At World Education, we value your privacy and are committed to protecting your personal data. This Privacy Policy outlines how we collect, use, and safeguard your information when you visit our platform, interact with our services, or engage with our content.</p>
        </div>
    </section>

    <!-- Terms of Use Section -->
    <section class="terms-section animate-fade-in">
        <div class="content">
            <h2>Terms of Use</h2>
            <p><strong>Effective Date:</strong> 2024</p>
            <p>By accessing or using World Education’s platform, you agree to abide by these Terms of Use. Please read them carefully before using our services.</p>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>
