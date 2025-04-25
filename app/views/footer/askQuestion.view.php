<?php include('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask Questions - Music Event Management System</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/askQuestions.css">
</head>
<body>
    <div class="container">
        <h1>Ask Questions</h1>
        
        <section class="faq-section">
            <h2>Frequently Asked Questions</h2>
            
            <div class="faq-item">
                <h3>How do I book an ticket?</h3>
                <p>To book an ticket, simply register an account, browse through our available events, select your preferred , and follow the booking process.</p>
            </div>

            <div class="faq-item">
                <h3>What types of events do you handle?</h3>
                <p>We handle various music events including concerts, live performances, music festivals, album launches, and private music events. Our experienced team can accommodate both small intimate gatherings and large-scale productions.</p>
            </div>


            <div class="faq-item">
                <h3>What payment methods do you accept?</h3>
                <p>We accept various payment methods including credit/debit cards and online payment systems. A deposit is required to secure your booking.</p>
            </div>

            <div class="faq-item">
                <h3>What is the administrative fee for event planners?</h3>
                <p>Event planners are required to pay a 0.05% administrative fee after the event completion. This fee helps us maintain and improve our platform's services and support.</p>
            </div>
        </section>

        <section class="contact-section">
            <h2>Still Have Questions?</h2>
            <p>Feel free to reach out to us using the form below:</p>

            <form  method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>
                </div>

                <div class="form-group">
                    <label for="message">Your Question:</label>
                    <textarea id="message" name="question" rows="5" required></textarea>
                </div>

                <input type="hidden" name="user_id" value="<?= isset($_SESSION['USER']->id) ? $_SESSION['USER']->id : 0 ?>"/>
                

                <button type="submit" name="submit" class="submit-btn">Send Message</button>
            </form>
        </section>
    </div>
</body>
</html>