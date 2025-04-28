<?php include('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Music Event Management System</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/about.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<body>
    <div class="container">

            <div class="back-button">
                
                    <!-- Include Back Button Component -->
                    <?php include('../app/views/components/backbutton.view.php'); ?>
                
                
            </div>
                
            <h1>About Us</h1>
            <p class="last-updated">Creating Unforgettable Musical Experiences Since 2025</p>
        

        <section class="our-story">
            <h2>Our Story</h2>
            <p>Music Event Management System was founded with a passion for bringing extraordinary musical experiences to life. We understand that every event is unique and deserves special attention to detail. Our journey began with a simple mission: to make event planning seamless and enjoyable for both organizers and attendees.</p>
        </section>

        <section class="our-mission">
            <h2>Our Mission</h2>
            <p>To revolutionize the music event industry by providing innovative solutions and exceptional service, ensuring every event becomes a memorable celebration of music and culture.</p>
        </section>

        <section class="why-choose-us">
            <h2>Why Choose Us?</h2>
            <div class="features-grid">
                <div class="feature">
                    <h3>Expertise</h3>
                    <p>Our team brings years of experience in event management and music industry knowledge.</p>
                </div>
                <div class="feature">
                    <h3>Full Service</h3>
                    <p>From venue selection to technical setup, we handle every aspect of your event.</p>
                </div>
               
                <div class="feature">
                    <h3>Quality Assurance</h3>
                    <p>We maintain high standards in every event we manage.</p>
                </div>
            </div>
        </section>

        <section class="team-section">
            <h2>Development Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="<?= ROOT ?>/assets/images/logo/sachith.jpeg" alt="Team Member 1" onclick="showPopup(this.src)">
                    <h3>Sachith Abeywardhana</h3>
                    <p>2022/CS/006</p>
                </div>

                <div class="team-member">
                    <img src="<?= ROOT ?>/assets/images/logo/irumi.jpeg" alt="Team Member 1" onclick="showPopup(this.src)">
                    <h3>Irumi Abeywickrama</h3>
                    <p>2022/CS/007</p>
                </div>

                <div class="team-member">
                    <img src="<?= ROOT ?>/assets/images/logo/thevindu.jpeg" alt="Team Member 1" onclick="showPopup(this.src)">
                    <h3>Thevindu Fernando</h3>
                    <p>2022/CS/054</p>
                </div>

                <div class="team-member">
                    <img src="<?= ROOT ?>/assets/images/logo/nethmi.jpeg" alt="Team Member 1" onclick="showPopup(this.src)">
                    <h3>Nethmi Hapuarachchi</h3>
                    <p>2022/CS/064</p>
                </div>
            </div>
        </section>

        <!-- Image Popup -->
        <div class="image-popup" onclick="hidePopup()">
            <img src="" alt="Popup Image">
        </div>

        <script>
            function showPopup(imageSrc) {
                const popup = document.querySelector('.image-popup');
                const popupImg = popup.querySelector('img');
                popupImg.src = imageSrc;
                popup.classList.add('active');
            }

            function hidePopup() {
                const popup = document.querySelector('.image-popup');
                popup.classList.remove('active');
            }
        </script>
    </div>
</body>
</html>