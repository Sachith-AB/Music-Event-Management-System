<?php include('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Use - Music Event Management System</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/terms.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<body>
    <div class="container">
        <!-- Include Back Button Component -->
        <?php include('../app/views/components/backbutton.view.php'); ?>
        <h1>Terms of Use</h1>
        <p class="last-updated">Last Updated: March 2024</p>

        <section class="terms-section">
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing and using the Music Event Management System website and services, you agree to be bound by these Terms of Use. If you do not agree to these terms, please do not use our services.</p>
        </section>

        <section class="terms-section">
            <h2>2. User Accounts</h2>
            <h3>2.1 Account Creation</h3>
            <p>To use our services, you must:</p>
            <ul>
                <li>Be at least 18 years old</li>
                <li>Provide accurate and complete information</li>
                <li>Maintain the security of your account</li>
                <li>Notify us of any unauthorized use</li>
            </ul>

            <h3>2.2 Account Responsibilities</h3>
            <p>You are responsible for:</p>
            <ul>
                <li>All activities under your account</li>
                <li>Maintaining confidentiality of your credentials</li>
                <li>Updating your account information</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>3. Ticket Booking and Payments</h2>
            <h3>3.1 Booking Terms</h3>
            <ul>
                <li>All bookings are subject to availability</li>
                <li>Prices are in LKR unless stated otherwise</li>
                <li>Booking confirmation is subject to payment</li>
                <li>Changes and cancellations are subject to our policy</li>
            </ul>

            <h3>3.2 Payment Terms</h3>
            <ul>
                <li>Payments must be made through approved methods</li>
                <li>Deposits may be non-refundable</li>
                <li>Additional charges may apply for changes</li>
            </ul>
        </section>

       

        <section class="terms-section">
            <h2>5. Prohibited Activities</h2>
            <p>Users must not:</p>
            <ul>
                <li>Violate any applicable laws</li>
                <li>Infringe on intellectual property rights</li>
                <li>Share false or misleading information</li>
                <li>Attempt to breach system security</li>
                <li>Resell or transfer bookings without authorization</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>6. Limitation of Liability</h2>
            <p>We are not liable for:</p>
            <ul>
                <li>Third-party service provider actions</li>
                <li>Force majeure events</li>
                <li>Indirect or consequential damages</li>
                <li>User-generated content</li>
            </ul>
        </section>

        <section class="terms-section">
            <h2>7. Changes to Terms</h2>
            <p>We reserve the right to modify these terms at any time. Continued use of our services after changes constitutes acceptance of the new terms.</p>
        </section>

       
    </div>
</body>
</html>
<?php include('../app/views/components/footer.php'); ?>