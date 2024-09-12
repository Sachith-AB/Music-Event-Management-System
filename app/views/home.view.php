<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Events</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/landing.css">
</head>





<body> 

    <section id ="treanding" class="trending-events">
        <h1>Discover Unforgettable Experience at</h1>
        <h1 class="highlight">Musicia</h1>
        <div class="search-bar">
            <input type="search" placeholder="Search...">
        </div>

        <div class="heading">
            <h2 class="top">Top 3</h2>
            <h2>trending events</h2>
        </div>
        <div class="events">
            <div class="event">
                <img src="<?=ROOT?>/assets/images/landing/top1.png" alt="Classical Serenade">
                <div class="event-info">
                    <div class="event-details">
                        <h3>Classical Serenade</h3>
                        <p class="date-time">Wed, November 26, 2024 | 8.00 PM</p>
                        <p class="venue">Royal College, auditorium</p>
                    </div>
                    <div class="pricing">
                        <p class="price-from">From LKR 3000</p>
                    </div>
                </div>
            </div>

            <div class="event">
                <img src="<?=ROOT?>/assets/images/landing/top2.png" alt="Melody Mania">
                <div class="event-info">
                    <div class="event-details">
                        <h3>Melody Mania</h3>
                        <p class="date-time">Thu, December 27, 2024 | 7.30 PM</p>
                        <p class="venue">City Hall, auditorium</p>
                    </div>
                    <div class="pricing">
                        <p class="price-from">From LKR 2000</p>
                    </div>
                </div>
            </div>

            <div class="event">
                <img src="<?=ROOT?>/assets/images/landing/top3.png" alt="Rock Fest Extravaganza">
                <div class="event-info">
                    <div class="event-details">
                        <h3>Rock Fest</h3>
                        <p class="date-time">Fri, December 30, 2024 | 9.00 PM</p>
                        <p class="venue">Central Park, auditorium</p>
                    </div>
                    <div class="pricing">
                        <p class="price-from">From LKR 5000</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--Event Browsing-->
    <div id="new-events">
        <div class="events-selection">
            <div class="events-header">
                <h2> New Events in
                    <select id="city-select">
                        <option value="colombo">Colombo</option>
                        <option value="kandy">Kandy</option>
                        <option value="galle">Galle</option>
                        <option value="jaffna">Jaffna</option>
                        <option value="kurunegala">Kurunegala</option>
                    </select>
                </h2>
                <button class="view-more-btn" onclick="toggleVisibility()">View more</button>
            </div>
        </div>
        <div class="category-buttons">
            <button onclick="setActiveButton(this)">All</button>
            <button onclick="setActiveButton(this)">Indoor</button>
            <button onclick="setActiveButton(this)">Outdoor</button>
        </div>

        <div class="events-container" id="events-container">
            <!-- Events will be dynamically inserted here -->
        </div>

    </div>
    <div class = "events-selection">
        <div class ="events-header">
            <h2>Upcoming 24 hours</h2>
        </div>
    </div>
    <div class = "events-container2" id = "events-container2">
        <!--Events Dynamically inserted here -->
    </div>

    <script src="<?=ROOT?>/assets/js/events.js"></script> 


</body>
</html>

<?php include ('../app/views/components/footer.php'); ?>
