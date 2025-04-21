<?php

    //Retrieving the data from the session
    $event_name = $_SESSION['event_data']['event_name']?? '';
    $audience = $_SESSION['event_data']['audience']?? '';
    $address= $_SESSION['event_data']['address']?? '';
    $eventDate = $_SESSION['event_data']['event_date']?? '';
    $start_time = $_SESSION['event_data']['start_time']?? '';
    $end_time = $_SESSION['event_data']['end_time']?? '';
    $pricing = $_SESSION['event_data']['pricing']?? '';
    $type = $_SESSION['event_data']['type']?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/eventUpdate.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body>
    <div class ="container">
        <div class = "popup">
            <div class = "event-content">
                <h1 class = "head1">Update Event Details</h1>

                <!--Event Details -->
                <form method = "POST" class = "form">
                    
                    <div class = "input-wrap">
                        <label for = "event-name">Event Name </label>
                        <input name = "event_name" type="text" value="<?php echo $data['event_name'] ?>">
                    </div>

                    <div class = "input-wrap">
                        <label for = "audience">Audience </label>
                        <input name = "audience" type="number" value="<?php echo $data['audience'] ?>">
                    </div>

                    <div class="input-wrap">
                        <label for = "city">Address</label>
                        <div class="search-container">
                            <input name="address" id='address' type="text" placeholder="address" value="<?php echo $data['address'] ?>">
                            <button type="button" class="search-button" id="search-button">Search</button>
                        </div>
                    </div>

                    <div id="map" class="map" style="height: 400px;"></div>

                    <br>

                    <div class ="input-wrap">
                        <label for = "eventDate">Date </label>
                        <input name ="event_date" id = "event-date" type = "date"  value="<?php echo $data['eventDate']?>">
                    </div>

                    <div class = "input-wrap">
                        <label for = "start_time">Start Time </label>
                        <input id = start_time name = "starttime" type="time" value="<?php echo date('H:i', strtotime($data['start_time'])); ?>">
                    </div>

                    <div class = "input-wrap">
                        <label for = "end_time">End Time </label>
                        <input id = "end_time" name ="endtime"  type="time" value="<?php echo date('H:i', strtotime($data['end_time'])); ?>">
                    </div>

                    <div class = "input-wrap">
                        <label> Type </label>
                        <div class = "radio-group">
                            <div class ="radio-item">
                                <input type = "radio" id = "indoor" name = "type" value = "indoor" <?php echo $data['type'] == 'indoor' ? 'checked' : ''; ?>>
                                <label for = "indoor">Indoor</label>
                            </div>
                            <div class ="radio-item">
                                <input type = "radio" id = "outdoor" name = "type" value = "outdoor" <?php echo $data['type'] == 'outdoor' ? 'checked' : ''; ?>>
                                <label for = "outdoor">Outdoor</label>
                            </div>
                        </div>
                    </div>

                    <input type = "hidden" id = "hidden-start-time" name="starttime">
                    <input type = "hidden" id = "hidden-end-time" name="endtime">
                    <input type = "hidden" id = "hidden-event-id" name = "id" value = "<?php echo $data['id'] ?>">

                    <script src="<?= ROOT ?>/assets/js/event/processingEventUpdate.js"></script>


                    
                    <!--Action Buttons -->
                    <div class = "button-wrap">
                        <button type = "button" onclick = "goBack()">Cancel</button>
                        <button type = "submit" name = "update">Done</button>


                </form>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.location.href = "event-planner-viewEvent?id=<?php echo $data['id']?>";
            window.history.back();
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


</body>
</html>



