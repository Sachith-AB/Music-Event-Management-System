<?php include ('../app/views/components/CreateEventHeader.php'); ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['last_visit'])){
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
    <title>Create an Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/create-event.css">
</head>
<body>
    
    <div class="container">

            <!--create slide bar -->
        <div class="sidebar">
            <div class="last-update">
                <h2>Create Event</h2>
                <p>Last Updated</p>
                <h3><?php echo  $last_visit; ?></h3>
                <p>Status</p>
                <h3> Draft</h3>
            </div>

            <div class="nav-links">
                <h2>Event Information</h2>
                <ul>
                    <li><a href="#upload-cover">Upload Cover</a></li>
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


        <!--create main content -->
        <div class="review-content">
            <section class="event-header">
                <img src="<?=ROOT?>/assets/images/event/cover.png" alt="Event Cover Image" class="cover-image">
                <div class= "event-info">
                    <h2>Event Title</h2>
                
                </div>

