<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase Success</title>
    
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/ticket/ticketholder-event.css">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Sen:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<bo>
    <?php include ('../app/views/components/loading.php'); ?>
    <!-- headersection -->
    <div class="headersection">
        <img src="<?=ROOT?>/assets/images/ticket/ticketevent-bg.jpg" alt="Musical Fusion Festival" class="headersection-img">
        <!-- <div class="overlay"></div>  -->
        <div class="uppersec">
            <div class="upper">
                <div class="eventname">
                    <span class="highlight"><?php echo $data['event']->event_name ?></span><br/> <?php echo $data['event']->description ?>
                </div>

            </div>
        </div>

        <div class="lowersec">
            <img src="<?=ROOT?>/assets/images/events/<?php echo $data['event']->cover_images?>" alt="Concert Image" class="concert-img">
            <!-- <div class="play-button">
                <span>&#9654;</span> Play Icon
            </div> -->
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
                        <div class="team-member">
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

        </div>
    </section>
    

    
</body>

</html>