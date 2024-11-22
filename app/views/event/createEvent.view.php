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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>
    <?php
    $error = htmlspecialchars($_GET['error'] ?? '');
    $error_no = htmlspecialchars($_GET['error_no'] ?? '');
    $flag = htmlspecialchars($_GET['flag'] ?? 0);
    ?>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="last-update">
                <h2>Create Event</h2>
                <p>Last Updated</p>
                <h3><?php echo $last_visit; ?></h3>
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
                    <li><a href="#review-publish">Review and Publish</a></li>
                </ul>
            </div>
        </div>

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
                        <textarea id="event_description" name="description"></textarea>
                    </div>
                </section>

                <section id="location-time">
                    <h2>Location</h2>
                    <p>You can choose the location or pinpoint it on the map</p>

                    <div class="search-container">
                        <input type="text" id="address" placeholder="Search for a location" class="search" name="address"/>
                        <button type="button" id="search-button">Search</button>
                    </div>

                    <div id="map" style="height: 400px;"></div>
                </section>

                <section id="review-publish">
                    <button type="submit" class="review-button" name="submit">Review</button>
                </section>
            </form>
        </div>
    </div>

    <?php if (!empty($data['error'])): ?>
        <?php 
            $message = $data['error'];
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
                        alert("Location not found!");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Error occurred while searching location.");
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
                    alert("Error occurred while fetching the address.");
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
</body>
</html>
