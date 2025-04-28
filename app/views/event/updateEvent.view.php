<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Retrieve event data from session
$event_name = $_SESSION['event_data']['event_name'] ?? '';
$audience = $_SESSION['event_data']['audience'] ?? '';
$address = $_SESSION['event_data']['address'] ?? '';
$eventDate = $_SESSION['event_data']['eventDate'] ?? '';
$start_time = $_SESSION['event_data']['start_time'] ?? '';
$end_time = $_SESSION['event_data']['end_time'] ?? '';
$pricing = $_SESSION['event_data']['pricing'] ?? '';
$type = $_SESSION['event_data']['type'] ?? '';

// Track last visit time
$last_visit = $_SESSION['last_visit'] ?? "This is my first visit";
$_SESSION['last_visit'] = date('Y-m-d H:i:s');
?>
<?php require_once '../app/helpers/load_notifications.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Event</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/eventUpdate.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/create-event.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body>
    <?php 
        $flag = htmlspecialchars($_GET['flag'] ?? 0);
        $error = htmlspecialchars($_GET['error'] ?? '');
        $error_no = htmlspecialchars($_GET['error_no'] ?? '');
    ?>
    <?php include ('../app/views/components/loading.php'); ?>
    <div class="event-update-container">
        <div class="event-update-popup">
            <div class="event-content">
                <h1 class="event-update-head1">Update Event Details</h1>
                
                <!-- Event Details Form -->
                <form method="POST" class="form">
               
                    <div class="event-update-input-wrap">
                        <label for="event_name">Event Name</label>
                        <input name="event_name" type="text" placeholder="EventName" value="<?php echo $data['event']['event_name'] ?>">
                    </div>

                    <div class="event-update-input-wrap">
                        <label for="description">Description</label>
                        <input name="description" type="text" placeholder="Description" value="<?php echo $data['event']['description'] ?>">
                    </div>

                    <div class="event-update-input-wrap">
                        <label for="audience">Audience</label>
                        <input name="audience" type="number" placeholder="Audience" min="0" value="<?php echo $data['event']['audience'] ?>">
                    </div>

                    <div class="event-update-input-wrap">
                        <label for="city">Address</label>
                        <div class="event-update-search-container">
                            <input name="address" id='address' type="text" placeholder="address" value="<?php echo $data['event']['address'] ?>">
                            <button type="button" class="event-update-search-button" id="search-button">Search</button>
                        </div>
                    </div>
               
                    <div id="map" class="map" style="height: 400px;"></div>

                    <br>
                    <div class="event-update-input-wrap">
                        <label for="eventDate">Event Date</label>
                        <input name="eventDate" id="event-date" type="date" value="<?php echo $data['event']['eventDate'] ?>" required>
                    </div>

                    <div class="event-update-input-wrap">
                        <label for="start_time">Start Time</label>
                        <input id="start-time" name="starttime" type="time" value="<?php echo date('H:i', strtotime($data['event']['start_time'])); ?>">
                    </div>

                    <div class="event-update-input-wrap">
                        <label for="end_time">End Time</label>
                        <input name="endtime" id="end-time" type="time" value="<?php echo date('H:i', strtotime($data['event']['end_time'])); ?>" required>
                    </div>

                    <div class="event-update-input-wrap">
                        <label>Pricing</label>
                        <div class="event-update-radio-group">
                            <div class="event-update-radio-item">
                                <input type="radio" id="free" name="pricing" value="free" <?php echo $data['event']['pricing'] == 'free' ? 'checked' : ''; ?>>
                                <label for="free">Free</label>
                            </div>
                            <div class="event-update-radio-item">
                                <input type="radio" id="paid" name="pricing" value="paid" <?php echo $data['event']['pricing'] == 'paid' ? 'checked' : ''; ?>>
                                <label for="paid">Paid</label>
                            </div>
                        </div>
                    </div>

                    <div class="event-update-input-wrap">
                        <label>Type</label>
                        <div class="event-update-radio-group">
                            <div class="event-update-radio-item">
                                <input type="radio" id="indoor" name="type" value="indoor" <?php echo $data['event']['type'] == 'indoor' ? 'checked' : ''; ?>>
                                <label for="indoor">Indoor</label>
                            </div>
                            <div class="event-update-radio-item">
                                <input type="radio" id="outdoor" name="type" value="outdoor" <?php echo $data['event']['type'] == 'outdoor' ? 'checked' : ''; ?>>
                                <label for="outdoor">Outdoor</label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="hidden-start-time" name="start_time">
                    <input type="hidden" id="hidden-end-time" name="end_time">
                    <script src="<?= ROOT ?>/assets/js/event/createEvent.js"></script>

                    <input type="hidden" name="event_id" value="<?php echo $data['event']['id'] ?>">

                    <!-- In the form section for images -->
                    <div class="event-update-input-wrap">
                        <?php if(isset($data['event']['cover_images']) && !empty($data['event']['cover_images'])): ?>
                            <div class="existing-images">
                                <h4>Cover Images</h4>
                                <div class="image-grid">
                                    <?php 
                                    $images = json_decode($data['event']['cover_images'], true) ?: [];
                                    foreach($images as $index => $image): 
                                    ?>
                                        <div class="image-item">
                                            <img src="<?=ROOT?>/assets/images/events/<?=$image?>" alt="Event Image <?=$index+1?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="event-update-button-wrap">
                            <button type="button" onclick="goBack()">Cancel</button>
                            <button type="submit" name="update">Done</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--<?php show($data); ?>-->
    <!-- Error Message Display -->
    <?php if (!empty($data['error']['errors']['error'])): ?>
        <?php 
            $message = $data['error']['errors']['error'];
            include("../app/views/components/r-message.php");
        ?>
    <?php endif ?>

    <script src="<?= ROOT ?>/assets/js/message.js"></script>
   
    <script>
        function goBack() {
            window.location.href = "event-review?event_name=<?php echo $data['event']['event_name']?>";
        }
    </script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Initialize the map
        var map = L.map('map').setView([6.9271, 79.8612], 13); // Default location (Colombo)

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Marker
        var marker = L.marker([6.9271, 79.8612],{draggable : true}).addTo(map);

        // When the marker is dragged, update the address
        marker.on('dragend', function (event) {
                var lat = event.target.getLatLng().lat;
                var lon = event.target.getLatLng().lng;
                
                // Fetch the address using Nominatim API based on the new position
                getAddress(lat, lon);
            });

        // Function to search location
        function searchLocation(query) {
            var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var result = data[0];
                        var lat = parseFloat(result.lat);
                        var lon = parseFloat(result.lon);
                        document.getElementById('address').value = result.display_name

                        // Update map view and marker
                        map.setView([lat, lon], 13);
                        marker.setLatLng([lat, lon]);
                        marker.bindPopup(result.display_name).openPopup();
                    } else {
                        //alert("Location not found!");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    //alert("Error occurred while searching location.");
                });
        }

        function getAddress(lat, lon) {
            var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        console.log(data)
                        document.getElementById('address').value = data.display_name; // Set the address in hidden input
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    //alert("Error occurred while fetching the address.");
                });
        }

        // Event listener for search
        document.getElementById("search-button").addEventListener("click", function () {
            var query = document.getElementById("address").value;
            if (query.trim() !== "") {
                searchLocation(query);
            } else {
                alert("Please enter a location to search.");
            }
        });
        window.onload = initMap;
    </script>

    <script src="<?=ROOT?>/assets/js/message.js"></script>
</body>
</html>

