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
<?php $error = htmlspecialchars($_GET['error']?? '');
$error_no = htmlspecialchars($_GET['error_no']?? '');
$flag = htmlspecialchars($_GET['flag']?? '');
?>

<body>
    <!-- <?php show($data)  ?> -->
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


        <!--create main content -->
        <div class="main-content">

            <form  method="POST" >

                <section id="general-information">
                    <h2>General Information</h2>

                    <div class="form-group">
                        <label for="event_name">Name</label>
                        <input type="text" id="event_name" name="event_name" placeholder="Make it catchy and memorable" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="event_description">Description</label>
                        <textarea id="event_description" name="description" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="audience">Audience</label>
                        <input type="number" id="audience" name="audience" />
                    </div>

                </section>
                

                <section id="location-time">
                    <h2>Location and Time</h2>
                    <p>You can choose the location or pinpoint it on the map</p>

                    <div class = "location-container">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Enter the city">
                        </div>

                        <div class = "form-group">
                            <label for ="province">Province</label>
                            <input type = "text" id="province" name = "province" placeholder = "Enter the province">
                        </div>
                    </div>

                <div class = "location-map">
                        <!--add map here-->
                </div>
                </section>

                <section id="time-ticket">
                    <div class="form-group">
                        <label for = "event-date">Event Date</label>
                        <input type="date" id="event-date" name="eventDate">
                    </div>

                    <div class="form-group">
                        <label for="start-time">Start Time</label>
                        <input type="time" id="start-time" name="start_time">
                    </div>

                    <div class="form-group">
                        <label for="end-time">End Time</label>
                        <input type="time" id="end-time" name="end_time">
                    </div>


                     <!-- Pricing Options -->
                    <section id="pricing-type">
                        <h2>Pricing and Type</h2>
                        <div class="form-group">
                        <label>Pricing</label>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="free" name="pricing" value="free" required>
                                <label for="free">Free</label>
                            </div>
                             <div class="radio-item">
                                <input type="radio" id="paid" name="pricing" value="paid" required>
                                <label for="paid">Paid</label>
                            </div>
                        </div>
                        </div>

                        <div class="form-group">
                        <label>Type</label>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="indoor" name="type" value="indoor" required>
                                <label for="free">Indoor</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="outdoor" name="type" value="outdoor" required>
                                <label for="outdoor">Outoor</label>
                            </div>
                    </div>
                </div>


                </section>

                    

                        <button type="submit" class="review-button" name="submit">Review</button>
                </section>
                

            </form>


            
            
        </div>
    </div>

    <!-- Show error -->
    <?php if (!empty($data['error'])): ?>
        <?php 
            $message = $data['error'];
            include("../app/views/components/r-message.php")
        ?>

    <?php elseif($flag == 1): ?>
        <?php 
            $message = $error;
            include("../app/views/components/r-message.php")
        ?>
    <?php endif ?>



<?php include ('../app/views/components/footer.php'); ?>

    <script src="<?=ROOT?>/assets/js/message.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
</body>
</html>