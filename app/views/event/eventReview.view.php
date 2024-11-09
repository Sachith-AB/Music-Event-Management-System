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
                <h2>Event Header</h2>
                <div class="event-cover">
                    <img src="<?=ROOT?>/assets/images/event/cover.png" alt="Event Cover Image" class="cover-image">
                    <div class="event-info">
                        <h2 id = "event title"><?php echo $data['event_name'] ?></h2>
                        <p><?php echo $data['description'] ?></p>
                    </div>
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

            <section id="review-publish">
                <h2>Review and Publish</h2>
                <lable class = "switch">
                    <input type = "checknox" >
                    <span class = "slider round"></span>
                </lable>
                <p>Set the publishing time to ensure that your event appears to the website at the designated time</p>
                <div class = "publish-date-time">
                    <div class = "form-group">
                        <lable for = "publish-date">Publish Date</lable>
                        <input type = "date" id = "publish-date" name = "publish-date">
                    </div>
                    <div class = "form-group">
                        <lable for = "publish-time">Publish Time</lable>
                        <input type = "time" id = "publish-time" name = "publish-time">
                    </div>
                </div>
            </section>
            
            <div class ="action-buttons">
                <button class = "change-button">Save Draft</button>
                <button class = "change-button">Update</button>
                <button class = "remove-button">Delete</button>
                <button class = "publish-button">Publish</button>
            </div>
        </div>
    </div>

    <?php include ('../app/views/components/footer.php'); ?>
</body>
</html>
