<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>
    <?php
    $error = htmlspecialchars($_GET['error'] ?? '');
    $error_no = htmlspecialchars($_GET['error_no'] ?? '');
    $flag = htmlspecialchars($_GET['flag'] ?? 0);
    ?>
    <?php include ('../app/views/components/loading.php'); ?>
    <div class="container">

        <!-- Main Content -->
        <div class="main-content">
            <form method="POST" enctype="multipart/form-data">
                <section id="general-information">
                    <h2>General Information</h2>
                    <div class="form-group">
                        <label for="event_name">Name</label>
                        <input type="text" id="event_name" name="event_name" placeholder="Make it catchy and memorable">
                    </div>
                    <div class="form-group">
                        <label for="event_description">Description</label>
                        <textarea id="event_description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="audience">Audience</label>
                        <input type="number" id="audience" name="audience" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="coverImage">Cover Images</label>
                        <input type="file" id="coverImage" name="coverImage[]" accept="image/*" multiple onchange="previewImages(this)" class="form-control">
                        <div id="imagePreviewContainer" style="display: flex; flex-wrap: wrap; margin-top: 10px;"></div>
                    </div>
                </section>

                <section id="time-ticket">
                    <h2>Date and Time</h2>
                    <div class="form-group">
                        <label for = "event-date">Event Start Date</label>
                        <input type="date" id="event-date" name="eventDate">
                    </div>

                    <div class="form-group">
                        <label for="start-time">Start Time</label>
                        <input type="time" id="start-time" name="starttime">
                    </div>

                    <div class="form-group">
                        <label for = "event-date">Event End Date</label>
                        <input type="date" id="event-date" name="eventEndDate">
                    </div>

                    <div class="form-group">
                        <label for="end-time">End Time</label>
                        <input type="time" id="end-time" name="endtime">
                    </div>

                    <input type="hidden" name="createdBy" value="<?= isset($_SESSION['USER']->id) ? $_SESSION['USER']->id : 0 ?>"/>

                    <input type="hidden" id="hidden-start-time" name="start_time">
                    <input type="hidden" id="hidden-end-time" name="end_time">
                    <script src="<?= ROOT ?>/assets/js/event/createEvent.js"></script>
                </section>
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
                    <section id="location-time">
                        <h2>Location</h2>
                        <p>You can choose the location or pinpoint it on the map</p>

                        <div class="search-container">
                            <input type="text" id="address" placeholder="Search for a location" class="search" name="address"/>
                            <button type="button" id="search-button">Search</button>
                        </div>

                        <div id="map" class="map" style="height: 400px;"></div>
                    </section>
                    <section id="review-publish">
                    <button type="submit" class="review-button" name="submit">Review</button>
                    </section>
            </form>
        </div>
    </div>

    <!--<?php show($data); ?> -->
    <?php if (!empty($data['errors'])): ?>
        <?php 
            $message = $data['errors']['error'];
            include("../app/views/components/r-message.php");
        ?>
    <?php elseif($flag == 1): ?>
        <?php 
            $message = $error;
            include("../app/views/components/r-message.php");
        ?>
    <?php endif ?>

    <?php include ('../app/views/components/footer.php'); ?>

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
                //alert("Please enter a location to search.");
            }
        });
        window.onload = initMap;

        function previewImages(input) {
            var previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = '';
            
            if (input.files) {
                // Limit to 5 images
                var filesCount = Math.min(input.files.length, 5);
                
                for (var i = 0; i < filesCount; i++) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        var previewDiv = document.createElement('div');
                        previewDiv.style.margin = '5px';
                        previewDiv.style.position = 'relative';
                        
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '4px';
                        
                        previewDiv.appendChild(img);
                        previewContainer.appendChild(previewDiv);
                    }
                    
                    reader.readAsDataURL(input.files[i]);
                }
                
               
            }
        }
    </script>

    <script src="<?=ROOT?>/assets/js/message.js"></script>
</body>
</html>
