<?php include ('../app/views/components/CreateEventHeader.php'); ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Retrieve event data from session
$event_name = $_SESSION['event_data']['event_name'] ?? 'Event Title';
$description = $_SESSION['event_data']['description'] ?? 'No description provided';
$audience = $_SESSION['event_data']['audience'] ?? 'N/A';
$city = $_SESSION['event_data']['city'] ?? 'N/A';
$province = $_SESSION['event_data']['province'] ?? 'N/A';
$eventDate = $_SESSION['event_data']['eventDate'] ?? 'N/A';
$start_time = $_SESSION['event_data']['start_time'] ?? 'N/A';
$end_time = $_SESSION['event_data']['end_time'] ?? 'N/A';
$pricing = $_SESSION['event_data']['pricing'] ?? 'N/A';
$type = $_SESSION['event_data']['type'] ?? 'N/A';


// Track last visit time
if (isset($_SESSION['last_visit'])) {
    $last_visit = $_SESSION['last_visit'];
} else {
    $last_visit = "This is my first visit";
}
$_SESSION['last_visit'] = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/create-event.css">
</head>
<?php $event_name = htmlspecialchars($_GET['event_name']?? '');
//show ($data);
?>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="last-update">
                <h2>View Event</h2>
                <p>Last Updated</p>
                <h3><?php echo $last_visit; ?></h3>
                <p>Status</p>
                <h3>Draft</h3>
            </div>

            <div class="nav-links">
                <h2>Event Information</h2>
                <ul>
                    <li><a href="#event-header">Event Header</a></li>
                    <li><a href="#general-information">General Information</a></li>
                    <li><a href="#location-time">Location and Time</a></li>
                    <li><a href="#pricing-type">Pricing and Type</a></li>
                </ul>
            </div>

            <div class="publish-event">
                <h2>Publish Event</h2>
                <ul>
                    <li><a href="#review-publish">Review and Publish</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <section id="event-header">
                <h1 >Event Header</h1>
                    <!-- <img src="<?=ROOT?>/assets/images/event/cover.png" alt="Event Cover Image" class="cover-image"> -->
                    <div class="image-scroll-container">
                        <img src="<?=ROOT?>/assets/images/events/1.jpg" alt="Event Image 1" class="event-image">
                        <img src="<?=ROOT?>/assets/images/events/2.jpg" class="event-image">
                        <img src="<?=ROOT?>/assets/images/events/3.jpg" class="event-image">
                        <img src="<?=ROOT?>/assets/images/events/4.jpg" class="event-image">
                        <img src="<?=ROOT?>/assets/images/events/5.jpg" class="event-image">
                    </div>
                    <div class="event-info">
                        <h2 id = "event title"><?php echo $data['event_name'] ?></h2>
                        <p><?php echo $data['description'] ?></p>
                    </div>
                
            </section>

            <section id="general-information">
                <h2>General Information</h2>
                <p class = "event-audience"><strong>Audience:</strong> <?php echo $data['audience'] ?></p>
            </section>

            <section id="location-time">
                <h2>Location and Time</h2>
                <p class = "event-city"><strong>City:</strong> <?php echo $data  ['city'] ?></p>
                <p class = "event-city"><strong>Province:</strong> <?php echo $data ['province'] ?></p>
                <p class = "event-date"><strong>Event Date:</strong> <?php echo $data ['eventDate'] ?></p>
                <p class = "event-time"><strong>Start Time:</strong> <?php echo $data ['start_time'] ?></p>
                <p class = "event-time"><strong>End Time:</strong> <?php echo $data ['end_time'] ?></p>
            </section>


            <!-- Pricing and Type Section -->
            <section id="pricing-type">
                <h2>Pricing and Type</h2>
                <p><strong>Pricing:</strong> <?php echo $data['pricing']; ?></p>
                <p><strong>Type:</strong> <?php echo $data['type']; ?></p>
            </section>

            <section id="review-publish">
                <h2>Review and Publish</h2>
                <p>Review the event details and publish the event</p>
            </section>



            <section>
                <h2>Do you want upload images?</h2>
                <button class = "upload-button" onclick="goUpdate()">Yes</button>
            </section>

            
            <div class ="action-buttons">
                <button class = "change-button" >Save Draft</button>
                <button class = "change-button" onclick="goUpdate()">Update</button>
                <button class = "remove-button" onclick="goDelete()">Delete</button>
                <button class = "publish-button" onclick="goTicket()">Next</button>
            </div>
        </div>
    </div>

    <?php include ('../app/views/components/footer.php'); ?>

    <script>
        function goUpdate(){
            window.location.href = "event-update?event_name=<?php echo $data['event_name']?>";
        }

        function goDelete(){
            window.location.href = "event-delete?event_name=<?php echo $data['event_name']?>";
        }

        function goTicket(){
            window.location.href = "create-ticket?event_id=<?php echo $data['id']?>";
        }
    </script>
</body>
</html>
