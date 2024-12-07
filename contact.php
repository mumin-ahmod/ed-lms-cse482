<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Contact Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Include Navbar -->
    <?php include 'header.php'; ?>
    <div class="contact-section">
        <h2 class="text-primary">Contact Us</h2>
        <p>If you have any questions or inquiries, please send us a message using the form below:</p>

        <!-- PHP script to handle form submission -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $message = $_POST["message"];
            $errors = [];

            // Validate input fields
            if (empty($name)) {
                $errors[] = "Name is required.";
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "A valid email is required.";
            }
            if (empty($phone)) {
                $errors[] = "Phone number is required.";
            }
            if (empty($message)) {
                $errors[] = "Message cannot be empty.";
            }

            // Display errors or success message
            if (count($errors) > 0) {
                echo "<div class='error-messages'>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo "</div>";
            } else {
                // Success: Process the form (e.g., send email, save to database)
                echo "<div class='success-message'>Thank you for contacting us! We will get back to you shortly.</div>";
            }
        }
        ?>

        <form action="contact.php" method="POST" class="animate-fade-in">
            <label for="name">Name <span class="required">*</span></label>
            <input type="text" name="name" id="name" placeholder="Your Name" required>

            <label for="email">Email <span class="required">*</span></label>
            <input type="email" name="email" id="email" placeholder="Your Email" required>

            <label for="phone">Phone <span class="required">*</span></label>
            <input type="tel" name="phone" id="phone" placeholder="Your Phone Number" required>

            <label for="message">Message <span class="required">*</span></label>
            <textarea name="message" id="message" rows="5" placeholder="Your Message" required></textarea>

            <button type="submit" class="btn-submit">Send Request</button>
        </form>
    </div>

    <!-- Contact Information Section -->
    <div class="branch-contact">
        <h1>Bangladesh Office</h1>

        <div class="branch">
            <h3>Banani - Headquarter</h3>
            <p><i class="fa fa-map-marker"></i> **, Road 12, Block E, Banani, Dhaka - 1213</p>
            <p><i class="fa fa-phone"></i> +88 019********</p>
        </div>

        <div class="branch">
            <h3>Dhanmondi - Branch</h3>
            <p><i class="fa fa-map-marker"></i> **, Road 3/A, Satmasjid Road, Dhanmondi, Dhaka - 1209</p>
            <p><i class="fa fa-phone"></i> +88 014********</< /p>
        </div>

        <div class="branch">
            <h3>Uttara - Branch</h3>
            <p><i class="fa fa-map-marker"></i> **, Gausul Azam Ave, Sector 13, Uttara, Dhaka - 1230</p>
            <p><i class="fa fa-phone"></i> +88 019********</< /p>
        </div>

        <div class="branch">
            <h3>Siddeshwari - Branch</h3>
            <p><i class="fa fa-map-marker"></i> **,41 Siddeshwari Circular Road, Dhaka - 1217</p>
            <p><i class="fa fa-phone"></i> +88 014********</< /p>
        </div>

        <div class="email-contact">
            <p><i class="fa fa-envelope"></i> Mail Us: <a href="mailto:help@xyz.com"><b>help@xyz.com</b></a></p>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>