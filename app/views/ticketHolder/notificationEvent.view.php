<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase Success</title>
    
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/ticketHolder/notificationevent.css">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Sen:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<body>
    <?php include ('../app/views/components/loading.php'); ?>
    <!-- headersection -->
    <div class="headersection">
        <img src="<?=ROOT?>/assets/images/ticket/ticketevent-bg.jpg" alt="Musical Fusion Festival" class="headersection-img">
        <!-- <div class="overlay"></div>  -->
        <div class="uppersec">
            <div>
                <div class="eventname">
                    <div class="back-button">
                        <!-- Include Back Button Component -->
                        <?php include('../app/views/components/backbutton.view.php'); ?>
                        <span class="highlight"><?php echo $data['event']->event_name ?></span>
                    </div>
                    
                    <?php echo $data['event']->description ?>
                </div>
                
                
                <!-- event planner -->
                <?php if (!empty($data["eventplanner"])): ?>
                    
                    <div class="event-planner" onclick="gotoPlannerProfile(<?= $data['eventplanner'][0]->createdBy ?>)">
                        <img src="<?= ROOT ?>/assets/images/user/<?= $data['eventplanner'][0]->pro_pic ?>" alt="Planner" class="planner-pic">
                        <div class="planner-info">
                            <span class="planner-label">Organized by</span>
                            <span class="planner-name"><?= $data['eventplanner'][0]->name ?></span>
                        </div>
                    </div>
                <?php endif; ?>


            </div>
        </div>

        <div class="lowersec">
            <img src="<?=ROOT?>/assets/images/events/<?php echo $data['event']->cover_images?>" alt="Concert Image" class="concert-img">
            <!-- <div class="play-button">
                <span>&#9654;</span> Play Icon
            </div> -->
        </div>
    </div>
    <!-- reply box for notification -->
  
    <div class="section3">
        <h2>Event Report</h2>
        <div class="report-container">
            <div class="report-section">
                <p>Do you want to view the report?</p>
                <button class="btn btn-primary" onclick="window.location.href='<?= ROOT ?>/event-planner-completedEvent?id=<?= htmlspecialchars($data['event']->id) ?>'">View Report</button>
            </div>
        </div>
    </div>

    <!-- eventdetails section -->
    <div class="eventdetails">
        <!-- image section -->
        <div class="eventimages">
            <div class="image1">
                <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg" alt="Image 1" class="img">
            </div>
            <div class="image2">
                <img src="<?=ROOT?>/assets/images/ticket/musicevent2.jpeg" alt="Image 2" class="img">
            </div>
            <div class="image3">
                <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Image 3" class="img">
            </div>
            <div class="image4">
                <img src="<?=ROOT?>/assets/images/ticket/musicevent4.jpg" alt="Image 4" class="img">
            </div>
            <div class="mid">
                <div class="overlay-text">Recent<br>Photos</div>
            </div>

        </div>
        <!-- details section -->
        <div class="details">
            <h2>Welcome to <?php echo $data['event']->event_name ?> <br/> You can join the event</h2>
            <div class="event-item">
                <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <h3>Date and Time</h3>
                    <p><?php echo $data['event']->start_time ?></p>
                </div>
            </div>
            
            <div class="event-item">
                <div class="icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <h3>Place</h3>
                    <p id="address"><?php echo $data['event']->address ?><br></p>
                </div>
                <div id="map" class="map" style="height: 200px; width: 500px;"></div>
            </div>
        </div>

    </div>
    <!-- performers section -->
    <section class="team-section">
        <div class="team-header">
            <h1>Meet the performers</h1>
            <!-- <p>Cupidatat sunt excepteur ipsum non. Ex consectetur amet eu commodo incididunt elit incididunt aliqua aliqua irure elit minim voluptate. Sit est nisi labore eiusmod et ad. Anim quis anim adipisicing quis cillum id ullamco officia do culpa voluptate exercitation nisi.</p> -->
        </div>

        <div class="team-grid-scrollable">
            
            <div class="team-grid">
                <?php if(!empty($data['performers'])): ?>
                    <?php foreach($data['performers'] as $perfotmer): ?>
                        <div class="team-member" onclick="gotoperformerprofile(<?php echo $perfotmer['id']?>)">
                            <img class="team-member-image" src="<?=ROOT?>/assets/images/user/<?php echo $perfotmer['pro_pic']?>" alt="Selina Valencia">
                            <div class="team-info">
                                <h3><?php echo $perfotmer['name'] ?></h3>
                                

                            </div>
                            <div class="social-icons">
                                <a href="<?php echo $perfotmer[0]->fb?>"><i class="fab fa-facebook-f"></i></a>
                                <a href="<?php echo $perfotmer[0]->twitter?>"><i class="fab fa-twitter"></i></a>
                                <a href="<?php echo $perfotmer[0]->insta?>"><i class="fab fa-instagram"></i></a>
                                <a href="<?php echo $perfotmer[0]->youtube?>"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>

                    <?php endforeach ?>
                <?php endif ?>
            </div>
            <script>
                function gotoperformerprofile(user_id){
                    window.location.href = "<?= ROOT ?>/collaborator-viewprofile?id=" + user_id;
                }
            </script>
        </div>
    </section>
    

    <!-- comment section -->
    <section class="comment-section">
        <div class="comment-header">
            <h1>Comments</h1>
        </div>

        <div class="comments-container">
                <!-- Comment Input -->
                <?php if($_SESSION['USER']->id != $_GET['id']): ?>
                    <form id="addcomments" method="POST">
                        <div class="add-comment">
                            <img src="<?=ROOT?>/assets/images/user/<?php echo $_SESSION['USER']->pro_pic ?>" alt="User Avatar" class="comment-avatar">
                            
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['USER']->id ?>"/>
                            <textarea class="comment-input" name="content" placeholder="Add a comment..."></textarea>                                
                            <button name="add_comment" class="post-comment-btn">Submit</button>
                        </div>
                    </from>
                <?php endif;?>
                <?php if (!empty($commentsForEvent)): ?>
                    <!-- Comments -->
                    <?php foreach ($commentsForEvent as $comment): ?>
                        <div class="comment">
                            <img src="<?=ROOT?>/assets/images/user/<?php echo $comment->sender_pro_pic ?>" alt="User Avatar" class="comment-avatar">
                            <div class="comment-content">
                                <div class="comment-header">
                                    <span class="comment-author"><?php echo $comment->sender_name ?></span>
                                    <span class="comment-date"><?= date('jS F Y, H:i A', strtotime($comment->created_at)) ?></span>
                                </div>
                                <p class="comment-text"><?php echo htmlspecialchars($comment->comment) ?></p>
                                <!-- <div class="comment-actions">
                                    <button class="like-btn">👍 <?php echo $comment->num_likes ?></button>
                                    
                                </div> -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                
                <?php endif; ?>

            </div>
    </section>


    
    <script>
        function gotoPlannerProfile(userid){
            window.location.href = "<?=ROOT?>/admin-vieweventplanner?id="+userid;
        }
    </script>
    
</body>

</html>
<?php include ('../app/views/components/footer.php'); ?>