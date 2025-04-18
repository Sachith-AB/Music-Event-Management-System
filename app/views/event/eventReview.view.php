
<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

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
<?php include ('../app/views/components/loading.php'); ?>
    <div class="container">
        
        <!-- Main Content -->
        <div class="main-content">
            <section id="event-header">
                <?php
                // Check if cover_images exists and is not empty
                if (isset($data['cover_images']) && !empty($data['cover_images'])) {
                    // Decode the JSON string to get the array of image names
                    $imageNames = json_decode($data['cover_images'], true);
                    
                    // If we have images, display them
                    if (is_array($imageNames) && count($imageNames) > 0) {
                        
                        // If there are multiple images, display them in a scrollable container
                        if (count($imageNames) > 1) {
                            echo '<div class="image-scroll-container">';
                            foreach ($imageNames as $imageName) {
                                echo '<img src="' . ROOT . '/assets/images/events/' . $imageName . '" alt="Event Image" class="event-image">';
                            }
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="no-images">No images available for this event</div>';
                    }
                } else {
                    echo '<div class="no-images">No images available for this event</div>';
                }
                ?>
                <div class="event-name-desc">
                    <h2 id="event title"><?php echo $data['event_name'] ?></h2>
                    <p class="event-description"><?php echo $data['description'] ?></p>
                </div>
            </section>

            <section id="general-information">
                <h2>General Information</h2>
                <p class = "event-audience"><strong>Audience:</strong> <?php echo $data['audience'] ?></p>
            </section>

            <section id="location-time">
                <h2>Location and Time</h2>
                <p class = "event-city"><strong>Address:</strong> <?php echo $data  ['address'] ?></p>
                <p class = "event-date"><strong>Event Date:</strong> <?php echo $data ['eventDate'] ?></p>
                <p class = "event-time"><strong>Start Time:</strong> <?php echo date('H:i', strtotime($data['start_time'])); ?></p>
                <p class = "event-time"><strong>End Time:</strong> <?php echo date('H:i', strtotime($data['end_time'])); ?></p>
            </section>


            <!-- Pricing and Type Section -->
            <section id="pricing-type">
                <h2>Pricing and Type</h2>
                <p><strong>Pricing:</strong> <?php echo $data['pricing']; ?></p>
                <p><strong>Type:</strong> <?php echo $data['type']; ?></p>
            </section>

            



            <!-- <section>
                <h2>Do you want upload images?</h2>
                <button class = "upload-button" onclick="goUpdate()">Yes</button>
            </section> -->

            
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
<?php include ('../app/views/components/footer.php'); ?>