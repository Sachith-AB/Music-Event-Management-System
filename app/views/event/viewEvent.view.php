<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase Success</title>
    
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/ticket/ticketholder-event.css">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Sen:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<bo>
    <?php include ('../app/views/components/loading.php'); ?>
    <!-- headersection -->
    <div class="headersection">
        <img src="<?=ROOT?>/assets/images/ticket/ticketevent-bg.jpg" alt="Musical Fusion Festival" class="headersection-img">
        <!-- <div class="overlay"></div>  -->
        <div class="uppersec">
            <div class="upper">
                <div class="eventname">
                    <span class="highlight"><?php echo $data['event']->event_name ?></span><br/> <?php echo $data['event']->description ?>
                </div>
                
                <div class="countdown-timer">
                    <div class="time-unit">
                        <span class="time" id="days">00</span> Days
                    </div>
                    <div class="time-unit">
                        <span class="time" id="hours">00</span> Hours
                    </div>
                    <div class="time-unit">
                        <span class="time" id="minutes">00</span> Minutes
                    </div>
                    <div class="time-unit">
                        <span class="time" id="seconds">00</span> Seconds
                    </div>
                </div>

                <script>
                    // Pass the PHP date to JavaScript
                    const eventDate = new Date("<?php echo $data['event']->start_time; ?>");

                    // Function to update the countdown timer
                    function updateCountdown() {
                        const now = new Date();
                        const timeRemaining = eventDate - now; // Time difference in milliseconds

                        if (timeRemaining <= 0) {
                            // Event started or passed
                            document.getElementById("days").innerText = "00";
                            document.getElementById("hours").innerText = "00";
                            document.getElementById("minutes").innerText = "00";
                            document.getElementById("seconds").innerText = "00";
                            clearInterval(countdownInterval); // Stop the countdown
                            return;
                        }

                        // Calculate time units
                        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                        // Update HTML
                        document.getElementById("days").innerText = String(days).padStart(2, '0');
                        document.getElementById("hours").innerText = String(hours).padStart(2, '0');
                        document.getElementById("minutes").innerText = String(minutes).padStart(2, '0');
                        document.getElementById("seconds").innerText = String(seconds).padStart(2, '0');
                    }

                    // Update the countdown every second
                    const countdownInterval = setInterval(updateCountdown, 1000);

                    // Initial call to display countdown right away
                    updateCountdown();
                </script>


            </div>
        </div>

        <div class="lowersec">
            <img src="<?=ROOT?>/assets/images/events/<?php echo $data['event']->cover_images?>" alt="Concert Image" class="concert-img">
            <!-- <div class="play-button">
                <span>&#9654;</span> Play Icon
            </div> -->
        </div>
    </div>

    <!-- eventdetails section -->
    <div class="eventdetails">
        <!-- image section -->
        <div class="eventimages">
            <div class="image image1">
                <img src="<?=ROOT?>/assets/images/ticket/musicevent1.jpg" alt="Image 1" class="img">
            </div>
            <div class="image image2">
                <img src="<?=ROOT?>/assets/images/ticket/musicevent2.jpeg" alt="Image 2" class="img">
            </div>
            <div class="image image3">
                <img src="<?=ROOT?>/assets/images/ticket/musicevent3.jpg" alt="Image 3" class="img">
            </div>
            <div class="image image4">
                <img src="<?=ROOT?>/assets/images/ticket/musicevent4.jpg" alt="Image 4" class="img">
            </div>
            <div class="mid">
                <div class="overlay-text">Recent<br>Photos</div>
            </div>

        </div>
        <!-- details section -->
        <div class="details">
            <h2>Welcome to <?php echo $data['event']->event_name ?> <br/> You can join the event</h2>
            <div class="event-item">
                <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <h3>Date and Time</h3>
                    <p><?php echo $data['event']->start_time ?></p>
                </div>
            </div>

            <div class="event-item">
                <div class="icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <h3>Place</h3>
                    <p id="address"><?php echo $data['event']->address ?><br></p>
                </div>
                <div id="map" class="map" style="height: 200px; width: 500px;"></div>
            </div>
        </div>

    </div>
    <!-- performers section -->
    <section class="team-section">
        <div class="team-header">
            <h1>Meet the performers</h1>
            <!-- <p>Cupidatat sunt excepteur ipsum non. Ex consectetur amet eu commodo incididunt elit incididunt aliqua aliqua irure elit minim voluptate. Sit est nisi labore eiusmod et ad. Anim quis anim adipisicing quis cillum id ullamco officia do culpa voluptate exercitation nisi.</p> -->
        </div>

        <div class="team-grid-scrollable">
            <div class="team-grid">
                <?php if(!empty($data['performers'])): ?>
                    <?php foreach($data['performers'] as $perfotmer): ?>
                        <div class="team-member">
                            <img class="team-member-image" src="<?=ROOT?>/assets/images/user/<?php echo $perfotmer->pro_pic?>" alt="Selina Valencia">
                            <div class="team-info">
                                <h3><?php echo $perfotmer->name ?></h3>
                                

                            </div>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>

                    <?php endforeach ?>
                <?php endif ?>
            </div>

        </div>
    </section>
    

    <!-- ticket section -->
    <div class="ticketbackground">
        <div class="pricing-container">
            <?php if(!empty($data['tickets'])): ?>
                <?php foreach($data['tickets'] as $ticket): ?>
                <div class="pricing-card">
                <h2>
                    <?php if($ticket->ticket_type == "SILVER"): ?>
                        <i class="fas fa-ticket-alt"></i>
                    <?php elseif($ticket->ticket_type == "GOLD"): ?>
                        <i class="fas fa-medal"></i>
                    <?php  else: ?>
                        <i class="fas fa-gem"></i>
                    <?php endif ?>
                    <?php echo $ticket->ticket_type?>
                </h2>
                <p class="price"><?php echo $ticket->price?></p>
                <?php if($ticket->ticket_type == "SILVER"): ?>
                    <ul>
                        <li>Access to general seating area</li>
                        <li>Free snacks during breaks</li>
                        <li><span class="not-included">❌</span> Priority entrance</li>
                        <li><span class="not-included">❌</span> Backstage access</li>
                        <li><span class="not-included">❌</span> Meet and greet with performers</li>
                    </ul>
                    <?php elseif($ticket->ticket_type == "GOLD"): ?>
                        <ul>
                            <li>Access to priority seating area</li>
                            <li>Free snacks and beverages</li>
                            <li>✅ Priority entrance</li>
                            <li><span class="not-included">❌</span> Backstage access</li>
                            <li><span class="not-included">❌</span> Meet and greet with performers</li>
                        </ul>
                    <?php  else: ?>
                        <ul>
                            <li>Access to VIP seating area</li>
                            <li>All-inclusive food and beverage</li>
                            <li>✅ Priority entrance</li>
                            <li>✅ Backstage access</li>
                            <li>✅ Meet and greet with performers</li>
                        </ul>
                    <?php endif ?>
                
                <button onclick="window.location.href='purchaseticket?id=<?= $ticket->id ?>'">Buy Ticket Now</button>
                </div>
            <?php endforeach ?>
            <?php endif ?>
            
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <script>
                var query = document.getElementById("address").textContent.trim();
                console.log(query)
                if (query.trim() !== "") {
                    displayEventLocation(query);
                }
                function displayEventLocation(address) {
                // Fetch latitude and longitude from the address
                var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`;
                
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            var lat = parseFloat(data[0].lat);
                            var lon = parseFloat(data[0].lon);
                            var displayName = data[0].display_name;

                            // Initialize the map at the location
                            var map = L.map('map').setView([lat, lon], 13);

                            // Add OpenStreetMap tiles
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '© OpenStreetMap'
                            }).addTo(map);

                            // Add a marker to the map
                            var marker = L.marker([lat, lon]).addTo(map);
                            marker.bindPopup(displayName).openPopup();
                        } else {
                            console.error("Location not found");
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching location:", error);
                    });
            }
            </script>
        </div>
    </div>
</body>

</html>