<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators\singerdashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCollaborators/calender.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include ('../app/views/components/loading.php'); ?>
    <div class="view-container">
        
        <div class="dashboard">
            <?php if (!empty($userdata)&&!empty($profiledata)): ?>
                <section class="headersection">
                    <img src="<?=ROOT?>/assets/images/eventCollaborators/blue_cover_pic.jpg" alt="Musical Fusion Festival" class="headersection-img">            
                    
                    <div class="uppersec">
                        <!-- Include Back Button Component -->
                        <?php include('../app/views/components/backbutton.view.php'); ?>
                        
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
                        <?php
                        $coverImages = json_decode($event->cover_images, true);
                        $firstImage = $coverImages[0] ?? ''; // fallback if empty
                        ?>
                        <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="<?= htmlspecialchars($event->event_name); ?>" class="event-image">
                            
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

            <!-- Calendar Section -->
            <div class="calendar-container">
                <h1>My Calendar</h1>
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <div id="messageContainer"></div>
                <div class="calendar">
                    <div class="calendar-header">
                        <button id="prevMonth">◀</button>
                        <h2 id="currentMonth"></h2>
                        <button id="nextMonth">▶</button>
                    </div>
                    <div class="calendar-grid">
                        <script id="events" type="application/json"><?= json_encode($data ?? []) ?></script>
                    </div>
                </div>
            </div>



            <!-- Comments Section -->
            
            <h2 class="comments-h2">Comments</h2>
            <div class="comments-container">
                <!-- Comment Input -->
                <?php if($_SESSION['USER']->id != $_GET['id']): ?>
                    <form id="addcomments" method="POST">
                        <div class="add-comment">
                            <img src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?>" alt="User Avatar" class="comment-avatar">
                            <input type="hidden" name="receiver_id" value="<?php echo $_GET['id'] ?>"/>
                            <input type="hidden" name="sender_id" value="<?php echo $_SESSION['USER']->id ?>"/>
                            <textarea class="comment-input" name="content" placeholder="Add a comment..."></textarea>                                
                            <button name="add_comment" class="post-comment-btn">Submit</button>
                        </div>
                    </form>
                <?php endif;?>

                <?php if (!empty($commentsForUser)): ?>
                    <!-- Display comments here -->
                    <!-- This is where you would loop through and display comments -->
                <?php endif; ?>
            </div>

            
            <div id="eventModal" class="modal">
                <div class="modal-content">
                    <span id="closeModal" class="close-button">&times;</span>
                    <h1 id="eventName">Event Title</h1>
                    <img id="eventImage" src="" alt="Event Image" style="height: 100px; width: 200px;" />
                    <p id="eventDescription">Event Description goes here.</p>
                    <p><strong>Date:</strong> <span id="eventDate"></span></p>
                    <p><strong>Time:</strong> <span id="eventTime"></span></p>
                </div>
            </div>
            <script src="<?=ROOT?>/assets/js/calander.js"></script>

        </div>
    </div>
</body>
<?php include ('../app/views/components/footer.php'); ?>
</html>