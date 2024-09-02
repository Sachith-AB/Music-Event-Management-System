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
</head>

<body>
    <!-- Include Header -->
    <?php include ('../app/views/components/Header.php'); ?>

    <!-- Main Content -->
    <main>
        <!-- Upper Section -->
        <section class="hero-section">
            <div class="background background-1"></div>
            <div class="background background-2"></div>
            <div class="overlay"></div>
            <div class="content">
                <p class="event-date">FEBRUARY 29 2024</p>
                <h1 class="event-title">Rock Revolt: A Fusion of Power and Passion</h1>
                <p class="event-subtitle">Join us for an electrifying night where heart-pounding rhythms and powerful vocals converge to create an unforgettable experience.</p>
                <div class="buttons">
                    <a href="#" class="btn btn-red">Get Tickets</a>
                    <a href="#" class="btn btn-blue">Learn More</a>
                </div>
            </div>
        </section>


        <div class="event-container">
            <!-- Middle Section -->
            <section class="middle-section">
                <div class="info-section">
                    <!-- Timing and Location -->
                    <h2>Timing and Location</h2>
                    <div class="information">
                        <div class="event-item">
                            <div class="icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <h3>Date and Time</h3>
                                <p>Saturday, February 20<br>08:00 PM</p>
                            </div>
                        </div>

                        <div class="event-item">
                            <div class="icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h3>Place</h3>
                                <p>Central Park, New York, NY<br>United States</p>
                            </div>
                        </div>
                    </div>

                    <div class="map">
                        <img src="<?= ROOT ?>/assets/images/ticket/map-image.png" alt="Map Location">
                    </div>

                    <!-- About Section -->
                    <h2>About Event</h2>
                    <div class="information">
                        <div class="event-item">
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h3>Duration</h3>
                                <p>2 Hours</p>
                            </div>
                        </div>
                        <div class="event-item">
                            <div class="icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div>
                                <h3>Ticket</h3>
                                <p>Email eTicket</p>
                            </div>
                        </div>
                    </div>
                    <p class="event-paragraph">
                        Rock Revolt: A Fusion of Power and Passion is an electrifying rock music event that brings together a diverse lineup of talented rock bands and artists. The event aims to showcase the raw energy, intense power...
                    </p>

                    <!-- Performers Section -->
                    <h2>Performers Profiles</h2>
                    <div class="carousel-container">
                        <div class="carousel-track-container">
                            <div class="card-container">
                                <!-- Performer Cards -->
                                <div class="card">
                                    <div class="card-image">
                                        <img src="<?= ROOT ?>/assets/images/ticket/performer1.jpeg" alt="Performer 1">
                                    </div>
                                    <div class="card-details">
                                        <h3>Chandler Bing</h3>
                                        <div class="social-icons">
                                            <a href="#"><i class="fas fa-user-circle"></i></a>
                                            <div class="heart-icon">
                                                <a href="#" id="heart"><i class="far fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add more performer cards here -->
                            </div>

                            <!-- Carousel Arrows -->
                            <i class="fa-solid fa-chevron-left arrow left-arrow"></i>
                            <i class="fa-solid fa-chevron-right arrow right-arrow"></i>
                        </div>
                    </div>

                    <!-- Musical Band Profile -->
                    <div class="band">
                        <div class="band-image">
                            <img src="<?= ROOT ?>/assets/images/ticket/band1.jpg" alt="Band Image">
                        </div>
                        <div class="band-info">
                            <h2>One Direction</h2>
                            <!--<p>A brief description of the band can go here.</p>-->
                        </div>
                    </div>
                </div>

                <!-- Ticket Price Section -->
                <div class="ticket-price">
                    <div class="price-info">
                        <p>Price</p>
                        <p><strong>$90 / Ticket</strong></p>
                    </div>
                    <button class="purchase-btn" onclick="goToPurchaseTickets()">Purchase Ticket</button>
                </div>
            </section>
        </div>
    </main>
    <script>
                function goToPurchaseTickets() {
                    window.location.href = "purchaseticket";
                }
            </script>

    <!-- JavaScript Files -->
    <script>
        // Pass the image paths from PHP to JavaScript
        const bandImages = [
            "<?= ROOT ?>/assets/images/ticket/band1.jpg",
            "<?= ROOT ?>/assets/images/ticket/band2.jpg",
            "<?= ROOT ?>/assets/images/ticket/band3.jpeg"
        ];

        let currentImageIndex = 0;

        function changeBandImage() {
            const bandImageElement = document.querySelector('.band-image img');
            currentImageIndex = (currentImageIndex + 1) % bandImages.length;
            bandImageElement.style.opacity = 0;

            setTimeout(() => {
                bandImageElement.src = bandImages[currentImageIndex];
                bandImageElement.style.opacity = 1;
            }, 1000);
        }

        // Set interval to change the image every 15 seconds
        setInterval(changeBandImage, 5000);
    </script>
</body>

</html>
