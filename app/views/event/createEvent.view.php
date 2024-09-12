<!-- <?php include ('../app/views/components/CreateEventHeader.php'); ?> -->

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
                    <li><a href="#ticket">Ticket</a></li>
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
            <form method="POST" enctype="multipart/form-data">
                <section id="upload-cover">
                    <h2>Upload Cover</h2>
                    <div class="upload-cover">
                        <img src="<?=ROOT?>/assets/images/event/cover.png" alt="Event Cover Image" class="cover-image">
                        <div class="buttons">
                            <input type="file" name="cover_image" id="cover_image">
                            <button type="button" class="change-button">Change</button>
                            <button type="button" class="remove-button">Remove</button>
                        </div>
                    </div>
                </section>

                <section id="general-information">
                    <h2>General Information</h2>
                    <div class="form-group">
                        <label for="event_name">Name</label>
                        <input type="text" id="event_name" name="event_name" placeholder="Make it catchy and memorable" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="event_description">Description</label>
                        <textarea id="event_description" name="event_description" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <option value="select">select</option>
                            <option value="indoor">Indoor</option>
                            <option value="outdoor">Outdoor</option>
                        </select>
                    </div>

                <div class="form-group">
                    <label for="performances">Performances</label>
                    <select id="performances" name="performances">
                        <option value="select">Select</option>
                        <option value="singer">Singers</option>
                        <option value="band">Bands</option>
                        <option value="dj">DJ & Sounds</option>
                        <option value="stage-supplier">Stage Suppliers</option>
                        <option value="announcer">Announcers</option>
                        <option value="decoration">Decorations</option>
                    </select>
                </div> 

                <div class="form-group">
                    <div class="performances">
                        <button type="button" id="search-button">Search</button>
                    </div>
                </div>
                </section>
                

                <section id="location-time">
                    <h2>Location and Time</h2>
                    <p>You can choose the location or pinpoint it on the map</p>

                    <div class = "location-container">
                        <div class = "location-inputs">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" placeholder="Enter the location of the event">
                        </div>
                        </div>
                    
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
                        <h2>Time Zone</h2>
                        <select id="time-zone" name="time-zone">
                        <option value="SLST">(GMT+05:30) Sri Lanka Standard Time (Sri Lanka)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <lable for = "event-date">Event Date</lable>
                        <input type="data" id="event-date" name="event_date">
                    </div>

                    <div class="form-group">
                        <label for="start-time">Start Time</label>
                        <input type="time" id="start-time" name="start_time">
                    </div>

                    <div class="form-group">
                        <label for="end-time">End Time</label>
                        <input type="time" id="end-time" name="end_time">
                    </div>

                    <div class="ticket-container">
                        <h3>Ticket</h3>
                        <div class="form-group">
                            <input type="radio" id="paid-ticket" name="ticket_type">
                            <lable for="paid-ticket">Paid</lable>
                            <input type="radio" id="free-ticket" name="ticket_type">
                            <lable for="free-ticket">Free</lable>
                        </div>

                        <div class="form-group">
                            <label for = "quantity">Quantity</label>
                            <input type = "number" id="quantity" name="quantity">
                        </div>

                        <div class="form-group">
                            <label for = "price">Price</label>
                            <input type = "number" id="price" name="price">
                        </div>
                    </div>

                    <div class = "sale-date-container">
                        <h3>Sale Date</h3>
                        <div class = "form-group">
                            <label for = "sale-start-date">Start Date</label>
                            <input type = "date" id="sale-start-date" name="sale_start_date">
                        </div>

                        <div class = "form-group">
                            <label for = "sale-start-time">Start Time</label>
                            <input type = "time" id="sale-start-time" name="sale_start_time">
                        </div>

                        <div class = "form-group">
                            <label for = "sale-start-date">End Date</label>
                            <input type = "date" id="sale-end-date" name="sale_end_date">
                        </div>

                        <div class = "form-group">
                            <label for = "sale-start-time">End Time</label>
                            <input type = "time" id="sale-start-time" name="sale_start_time">
                        </div>

                        <button type="submit" class="review-button" name="submit">Review</button>
                </section>

            </form>
        </div>
    </div>

    <?php include ('../app/views/components/footer.php'); ?>
</body>
</html>
