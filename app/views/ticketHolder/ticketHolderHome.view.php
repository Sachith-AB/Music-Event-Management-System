<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Trending Events</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticketHolder/home.css">
</head>
<body>
<div class="block">
    <section id ="treanding" class="trending-events">
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
                        <button class="details-btn">Details</button>
                        <button class="wishlist-btn">Add to Wishlist</button>
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
                        <h3>Melody</h3>
                        <p class="date-time">Thu, December 27, 2024 | 7.30 PM</p>
                        <p class="venue">City Hall, auditorium</p>
                        <button class="details-btn">Details</button>
                        <button class="wishlist-btn">Add to Wishlist</button>
                    </div>
                    <div class="pricing">
                        <p class="price-from">From LKR 2000</p>
                    </div>
                </div>
            </div>


            <div class="event">
                <img src="<?=ROOT?>/assets/images/landing/top3.png" alt="Melody Mania">
                <div class="event-info">
                    <div class="event-details">
                        <h3>Combo Fest</h3>
                        <p class="date-time">Thu, December 27, 2024 | 7.30 PM</p>
                        <p class="venue">City Hall, auditorium</p>
                        <button class="details-btn">Details</button>
                        <button class="wishlist-btn">Add to Wishlist</button>
                    </div>
                    <div class="pricing">
                        <p class="price-from">From LKR 2000</p>
                    </div>
                </div>
            </div>


            <div class="event">
                <img src="<?=ROOT?>/assets/images/landing/top2.png" alt="Melody Mania">
                <div class="event-info">
                    <div class="event-details">
                        <h3>Nadha </h3>
                        <p class="date-time">Thu, December 27, 2024 | 7.30 PM</p>
                        <p class="venue">City Hall, auditorium</p>
                        <button class="details-btn">Details</button>
                        <button class="wishlist-btn">Add to Wishlist</button>
                    </div>
                    <div class="pricing">
                        <p class="price-from">From LKR 2000</p>
                    </div>
                </div>
            </div>


            <div class="event">
                <img src="<?=ROOT?>/assets/images/landing/top2.png" alt="Rock Fest Extravaganza">
                <div class="event-info">
                    <div class="event-details">
                        <h3>Swaraa</h3>
                        <p class="date-time">Fri, December 30, 2024 | 9.00 PM</p>
                        <p class="venue">Central Park, auditorium</p>
                        <button class="details-btn">Details</button>
                        <button class="wishlist-btn">Add to Wishlist</button>
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
                <h2> New Events </h2>
                <button class="view-more-btn" onclick="toggleVisibility()">View more</button>
            </div>
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
    </div>

    <script src="<?=ROOT?>/assets/js/holder.js"></script> 
</body>
</html>
