<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators\singerdashboard.css">
</head>
<body>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/collaborator/singersidebar.php');  ?>
        <div class="dashboard">
            <section class="headersection">
                <img src="<?=ROOT?>/assets/images/eventCollaborators/blue_cover_pic.jpg" alt="Musical Fusion Festival" class="headersection-img">
                <div class="uppersec">
                    <img src="<?=ROOT?>/assets/images/ticket/profilepic-icon.jpg" alt="Profile Picture" class="profile-picture">
                    <div class="profile-info">
                        <h1>Mina Winkel</h1>
                        <p> jazz, pop Singer</p>
                    </div>
                    <!-- <div class="action-buttons">
                        <button class="hire-me">Profile</button>
                    </div> -->
                </div>    
            </section>
            <div class="profile-section">
                <!-- Left Section -->
                <div class="profile-left">
                    <div class="about-me">
                        <h2>About me</h2>
                        <p>
                            I'm a singer based in [Location]. I specialize in [genres] and have a passion for delivering unforgettable performances. Whether it's a small private gathering or a large public event, I bring my unique style and energy to every stage.
                        </p>   
                    </div>
                    <br/>
                    <div class="experience">
                        <h3>Experinces and Special Movements</h3>
                        <div class="singerimages">
                            <div class="image image1">
                                <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg" alt="Image 1" class="img">
                            </div>
                            <div class="image image2">
                                <img src="<?=ROOT?>/assets/images/ticket/musicevent2.jpeg" alt="Image 2" class="img">
                            </div>
                            <div class="image image3">
                                <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Image 3" class="img">
                            </div>
                            <div class="image image4">
                                <img src="<?=ROOT?>/assets/images/ticket/musicevent4.jpg" alt="Image 4" class="img">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="profile-right">
                    <div class="skills">
                        <h3>Skills</h3>
                        <div class="skill-tags">
                            <span class="skill">Singing</span>
                            <span class="skill">Songwriting</span>
                            <span class="skill">Live Performance</span>
                        </div>
                    </div>
                    <div class="contact-info">
                        <h3>Website</h3>
                        <a href="#">mysingerwebsite.com</a>
                        <h3>Email</h3>
                        <a href="mailto:hello@mysingerwebsite.com">hello@mysingerwebsite.com</a>
                    </div>
                    <div class="social-links">
                        <h3>Connect with me</h3>
                        <div class="social-icons">
                            <a href="https://www.facebook.com" class="social-icon facebook" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.twitter.com" class="social-icon twitter" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.instagram.com" class="social-icon instagram" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.youtube.com" class="social-icon youtube" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <h2 class="upcomming-h2">Upcoming Events</h2>
            <div class="events-container">
                <div class="event-card">
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent5.jpg">
                    <div>
                        <div>Music Fest</div>
                        <div>
                            <div>📅 2nd November 2024</div>
                            <div>📍 Marata,Matara</div>
                        </div>
                    </div>
                </div>

                <div class="event-card">
                    <img src="<?=ROOT?>/assets/images/events/image-1.jpg">
                    <div>
                        <div>Music Fest</div>
                        <div>
                            <div>📅 2nd November 2024</div>
                            <div>📍 Marata,Matara</div>
                        </div>
                    </div>
                </div>

                <div class="event-card">
                    <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg">
                    <div>
                        <div>Music Fest</div>
                        <div>
                            <div>📅 2nd November 2024</div>
                            <div>📍 Marata,Matara</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>