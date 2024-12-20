<?php include ('../app/views/components/header.php'); ?>
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
            <?php if (!empty($userdata)&&!empty($profiledata)): ?>
                <section class="headersection">
                    <img src="<?=ROOT?>/assets/images/eventCollaborators/blue_cover_pic.jpg" alt="Musical Fusion Festival" class="headersection-img">
                    <div class="uppersec">
                        <img src="<?=ROOT?>/assets/images/user/<?php echo $userdata['pro_pic'] ?>" alt="Profile Picture" class="profile-picture">
                        <div class="profile-info">
                            <h1><?php echo $userdata['name'] ?></h1>
                            <?php if (isset($profiledata['profile']['user_role']) && 
                            ($profiledata['profile']['user_role'] === 'singer' || $profiledata['profile']['user_role'] === 'band')): ?>
                                <p><?php echo $profiledata['profile']['music_genres'] ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- <div class="action-buttons">
                            <button class="hire-me">Profile</button>
                        </div> -->
                    </div>    
                </section>
                <div class="profile-section">
                    <!-- Left Section -->
                    <div class="profile-left">
                        <?php if (!empty($profiledata['profile']['biography'])):?>
                            <div class="about-me">
                                <h2>About <?php if (($profiledata['profile']['user_role'] === 'singer' || $profiledata['profile']['user_role'] === 'announcer')): ?>me<?php else: ?>us<?php endif; ?></h2>
                                <p>
                                    <?php echo $profiledata['profile']['biography'] ?>
                                </p>   
                            </div>
                        <?php endif; ?>
                        <br/>
                        <?php if (!empty($profiledata['past_works'])): ?>
                            <div class="experience">
                                <h3>Experinces and Special Movements</h3>
                                <ul>
                                    <?php foreach ($profiledata['past_works'] as $work): ?>
                                        <li class="experiencepoint"><?php echo $work['past_work']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($profiledata['services'])): ?>
                            <div class="experience">
                                <h3>Services</h3>
                                <ul>
                                    <?php foreach ($profiledata['services'] as $work): ?>
                                        <li class="experiencepoint"><?php echo $work['service']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Right Section -->
                    <div class="profile-right">
                        <?php if (!empty($profiledata['profile']['skills'])): ?>
                            <div class="skills">
                                <h3>Skills</h3>
                                <div class="skill-tags">
                                    <span class="skill"><?php echo $profiledata['profile']['skills']; ?></span>
                                    <!-- <span class="skill">Songwriting</span>
                                    <span class="skill">Live Performance</span> -->
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="contact-info">
                            <!-- <h3>Website</h3>
                            <a href="#">mysingerwebsite.com</a> -->
                            <?php if (isset($_SESSION['USER']) && $_SESSION['USER']->role !== 'holder'): ?>
                                <?php if (!empty($userdata['contact'])): ?>
                                    <h3>Contact</h3>
                                    <a><?php echo $userdata['contact']; ?></a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['USER']) && $_SESSION['USER']->role !== 'holder'): ?>
                                <h3>Email</h3>
                                <a href="mailto:<?php echo $userdata['email']; ?>"><?php echo $userdata['email']; ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="social-links">
                            <h3>Connect with me</h3>
                            <div class="social-icons">
                                <?php 
                                // Function to prepend 'https://' if missing
                                function ensure_protocol($url) {
                                    if (!empty($url) && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
                                        return "https://" . $url;
                                    }
                                    return $url;
                                }
                                ?>
                                
                                <?php if (!empty($profiledata['profile']['fb'])): ?>
                                    <a href="<?php echo ensure_protocol($profiledata['profile']['fb']); ?>" class="social-icon facebook" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($profiledata['profile']['twitter'])): ?>
                                    <a href="<?php echo ensure_protocol($profiledata['profile']['twitter']); ?>" class="social-icon twitter" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($profiledata['profile']['insta'])): ?>
                                    <a href="<?php echo ensure_protocol($profiledata['profile']['insta']); ?>" class="social-icon instagram" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($profiledata['profile']['youtube'])): ?>
                                    <a href="<?php echo ensure_protocol($profiledata['profile']['youtube']); ?>" class="social-icon youtube" target="_blank" rel="noopener noreferrer">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                <?php endif; ?>
                            </div>


                        </div>
                    </div>

                </div>
            <?php else: ?>
                <p>No such collaborator</p>
            <?php endif; ?>
            <?php if (!empty($upcomingEvents)): ?>
                <h2 class="upcomming-h2">Upcoming Events</h2>
                <div class="events-container">
                    <?php foreach ($upcomingEvents as $event): ?>
                        <div class="event-card">
                            <!-- Display cover image if available -->
                            <img src="<?= !empty($event->cover_images) ? ROOT . "/assets/images/events/" . $event->cover_images : ROOT . "/assets/images/ticket/musicevent5.jpg"; ?>" alt="<?= htmlspecialchars($event->event_name); ?>" class="event-image">
                            
                            <div class="event-details">
                                <!-- Event Name -->
                                <div class="event-name"><?= htmlspecialchars($event->event_name); ?></div>
                                
                                <!-- Event Date and Address -->
                                <div class="event-meta">
                                    <div>📅 <?= date('jS F Y', strtotime($event->eventDate)); ?></div>
                                    <div>📍 <?= !empty($event->address) ? htmlspecialchars($event->address) : 'Location not specified'; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>