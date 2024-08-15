<?php include ('../app/views/components/CreateEventHeader.php'); ?>

<?php


if(isset($_SESSION['last_visit'])){
    $last_visit = $_SESSION['last_visit'];
}else {
        $last_visit = "This is my first visit";
}

$_SESSION['last_visit'] = date('Y-m-d H:i:s');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Events</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventCreate.css">
</head>
<body>
    <div class = "container">
        <div class = "siderbar">
            <div class = "last-update">
                <h2>Last update</h2>
                <p><?php echo $last_visit; ?></p>
            </div>

            <div class = "nav-links">
                <h2>Event information</h2>
                <ul>
                    <li><a href="#upload-cover">Upload cover</a></li>
                    <li><a href="#general-information">General information</a></li>
                    <li><a href="#location-time">Location and time</a></li>
                    <li><a href ="#publish-event">Review and publish</a></li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <form action = "submit_event.php" method = "POST" enctype="multipart/form-data">
                <section id="upload-cover">
                    <h2>Upload cover</h2>
                    <div class="upload-cover">
                        <img src="cover.png" alt="Event Cover Image" class="cover-image">
                        <div class="upload-options">
                            <input type = "file" name="cover_image" id="cover_image">
                            <button type = "button" class="change-button">Change</button>
                            <button type = "button" class="remove-button">Remove</button>
                        </div>
                    </div>
                </section>

                <section id="general-information">
                    <h2>General information</h2>
                    <div class = "form-group">
                        <label for = "event_name">Name</label>
                        <input type = "text" id="event_name" name="event_name" placeholder="Mrk it catchy and memorable" required>
                    </div>
                     
                    <div class="form-group">
                        <label for="event_description">Description</label>
                        <textarea id="event_description" name="event_description" placeholder="Provide essential event dtails"></textarea>
                    </div>

                    <div class="form-group">
                        <label for = "category">Category</label>
                        <select id="category" name="category">
                            <option value = "Indoor">Indoor</option>
                            <option value = "Outdoor">Outdoor</option>
                        </select>
                    </div>

                    <div class = "form-group">
                        <label for = "performances">Performances</label>
                        <div class="performances">
                            <input type="text" id="search-collaborators" placeholder="Search for collaboratore">
                            <button type = "button" id="search-button">Search</button>
                        </div>
                    </div>

                </div>
                </section>


                <section id="local-time">
                    <h2>Location and time</h2>
                    <div class="form-group">
                        <label for = "address">Location</label>
                        <input type="text" id="address" name="address" placeholder="Enter the location of the event">
                    </div>
                    <div class="form-group">
                        <label for = "city">City</label>
                        <input type="text" id="city" name="city" placeholder="city">
                    </div>
                    
                </section>
            </form>
        </div>
    </div>

</body>
<?php include ('../app/views/components/footer.php'); ?>
