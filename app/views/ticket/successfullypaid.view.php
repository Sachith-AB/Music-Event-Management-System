<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase Success</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/ticket/ticketstyle.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/ticket/popupmodal-style.css">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <!-- Include Header -->
    <div class="header">

    </div>
    <!-- Main Content -->
    <main>
        <div class="event-details-container">
            <div class="success-message">
                <div class="success-icon">
                    &#10004;
                </div>
                <div class="success-text">
                    Successful payment!
                </div>
            </div>
            <h1 class="event-title">Rock Revolt: A Fusion of Power and Passion</h1>
            <div class="event-info">
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
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h3>Duration</h3>
                        <p>2 Hours</p>
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
                <div class="event-item">
                    <div class="icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div>
                        <h3>Ticket</h3>
                        <p>2 tickets</p>
                    </div>
                </div>
            </div>


            <div class="event-details-container">
                <!--purchase information-->
                <div class="contact-header">
                    <h2>Purchase Information</h2>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <label for="first-name">Code</label>
                        <p>#123456789</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Date</label>
                        <p?>June 01,2023</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Total</label>
                        <p>$162</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Payment method</label>
                        <p>Matercard-****3456</p>
                    </div>
                </div>


                <!--contact information-->
                <div class="contact-header">
                    <h2>Contact Information</h2>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <label for="first-name">Fname</label>
                        <p>Amanda</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Lname</label>
                        <p?>Smith</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Email</label>
                        <p>amanda@gmail.com</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Phone number</label>
                        <p>(724)4546798</p>
                    </div>
                </div>





            </div>

            <!--ticket section-->

            <div class="event-details-container">
                <div class="contact-header">
                    <h3>Ticket (2) total: <span>$162</span></h3>
                    <a href="#" class="login-link" onclick="openModal()">View Ticket</a>
                </div>


                <!--modal foe ticket view button-->
                <div id="ticketModal" class="modal">


                    <div class="modal-content">
                        <!--ticket 1-->
                        <div class="digiticket">
                            <div class="digiticket-left">
                                <div class="digiticket-qr-code">
                                    <img src="<?= ROOT ?>/assets/images/ticket/QR_code-image.png" alt="QR Code">
                                </div>
                                <div class="digiticket-qr-code-part">
                                    <p><strong>Code</strong></p>
                                    <a href="#">MRCE-934912</a>
                                </div>
                            </div>
                            <div class="digiticket-right">
                                <div class="digiticket-content">
                                    <h1 class="digievent-title">Night Music Festival</h1>
                                    <p class="digievent-subtitle">Get ready for the best music festival.</p>
                                    <p class="digievent-date">16 May, 2023 8PM / at Keithston Stadium, 123 Anywhere St., Any City</p>
                                    <div class="digiticket-price">
                                        <p class="price-label">Public Ticket</p>
                                        <p class="price-value">$55.00</p>
                                        <p class="price-desc">One ticket for one person.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--ticket2-->
                        <div class="digiticket">
                            <div class="digiticket-left">
                                <div class="digiticket-qr-code">
                                    <img src="<?= ROOT ?>/assets/images/ticket/QR_code-image.png" alt="QR Code">
                                </div>
                                <div class="digiticket-qr-code-part">
                                    <p><strong>Code</strong></p>
                                    <a href="#">MRCE-934912</a>
                                </div>
                            </div>
                            <div class="digiticket-right">
                                <div class="digiticket-content">
                                    <h1 class="digievent-title">Night Music Festival</h1>
                                    <p class="digievent-subtitle">Get ready for the best music festival.</p>
                                    <p class="digievent-date">16 May, 2023 8PM / at Keithston Stadium, 123 Anywhere St., Any City</p>
                                    <div class="digiticket-price">
                                        <p class="price-label">Public Ticket</p>
                                        <p class="price-value">$55.00</p>
                                        <p class="price-desc">One ticket for one person.</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                                
                       

                    </div>
                </div>

                <script src="<?= ROOT ?>/assets/js/ticker/ticket-popup.js"></script>

            </div>

            <!--<script>
        function openModal() {
            document.getElementById("ticketModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("ticketModal").style.display = "none";
        }
    </script>-->



            <!-- Ticket 1 -->
            <div class="ticket-details">
                <div class="ticket-header">
                    <h3>Ticket 1</h3>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <label for="first-name">Fname</label>
                        <p>Amanda</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Lname</label>
                        <p?>Smith</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Email</label>
                        <p>amanda@gmail.com</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Phone number</label>
                        <p>(724)4546798</p>
                    </div>
                    <div class="input-field">
                        <div class="qr-code">
                            <div class="qr-code-part">
                                <p><strong>Code</strong></p>
                                <a href="#">MRCE-934912</a>
                            </div>
                            <img src="<?= ROOT ?>/assets/images/ticket/QR_code-image.png" alt="QR Code">
                        </div>
                    </div>
                </div>
            </div>


            <!-- Ticket 2 -->
            <div class="ticket-details">
                <div class="ticket-header">
                    <h3>Ticket 2</h3>
                </div>
                <div class="input-group">
                    <div class="input-field">
                        <label for="first-name">Fname</label>
                        <p>Amanda</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Lname</label>
                        <p?>Smith</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Email</label>
                        <p>amanda@gmail.com</p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Phone number</label>
                        <p>(724)4546798</p>
                    </div>
                    <div class="input-field">
                        <div class="qr-code">
                            <div class="qr-code-part">
                                <p><strong>Code</strong></p>
                                <a href="#">MRCE-934912</a>
                            </div>
                            <img src="<?= ROOT ?>/assets/images/ticket/QR_code-image.png" alt="QR Code">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Ticket Button -->
            <div class="button-group">
                <button type="button" class="add-ticket-btn" onclick="goToMyTickets()">Go to my ticket</button>
            </div>


            <script>
                function goToMyTickets() {
                    window.location.href = "upcommingevent";
                }
            </script>

        </div>

        <!--summary section -->
        <div class="summary-container" id="summary">
            <div class="summary-row">
                <p>2 x</p>
                <p>$90 / Ticket</p>
            </div>

            <div class="summary-row">
                <p>Subtotal</p>
                <p>$180</p>
            </div>

            <div class="summary-row">
                <p>Discount</p>
                <p>- $18 (10%)</p>
            </div>

            <div class="summary-total">
                <p>Total</p>
                <p>$162</p>
            </div>
            <div class="payment-method">
                <img src="<?= ROOT ?>/assets/images/ticket/mastercard-icon.png" alt="Mastercard">
                <span>Mastercard **** 5987</span>
            </div>
            <button class="pay-now-btn">Pay now</button>
        </div>

        <script>
            function showSummary() {
                document.getElementById('summary').style.display = 'block';
            }
        </script>

        <!--other event section-->
        <div class="event-details-container">
            <h2>Other events you may like</h2>

            <div class="musicevent-events-container">
                <div class="musicevent-event-card">
                    <div class="musicevent-event-badge">20% OFF</div>
                    <img src="<?= ROOT ?>/assets/images/ticket/musicevent1.jpg" alt="Musical Fusion Festival" class="musicevent-event-image">
                    <div class="musicevent-event-info">
                        <div class="musicevent-event-title">Musical Fusion Festival</div>
                        <div class="musicevent-event-details">
                            <div>📅 Monday, June 06 | 06:00 PM</div>
                            <div>📍 New York, NY</div>
                        </div>
                        <div class="musicevent-event-price">From $80</div>
                    </div>
                </div>

                <div class="musicevent-event-card">
                    <div class="musicevent-event-badge">Buy 2 get 1 free</div>
                    <img src="<?= ROOT ?>/assets/images/ticket/musicevent2.jpeg" alt="Metropolis Marathon" class="musicevent-event-image">
                    <div class="musicevent-event-info">
                        <div class="musicevent-event-title">Metropolis Marathon</div>
                        <div class="musicevent-event-details">
                            <div>📅 Tuesday, June 07 | 06:00 AM</div>
                            <div>📍 Atlanta</div>
                        </div>
                        <div class="musicevent-event-price">From $10</div>
                    </div>
                </div>

                <div class="musicevent-event-card">
                    <div class="musicevent-event-badge">Buy 2 get 1 free</div>
                    <img src="<?= ROOT ?>/assets/images/ticket/musicevent2.jpeg" alt="Metropolis Marathon" class="musicevent-event-image">
                    <div class="musicevent-event-info">
                        <div class="musicevent-event-title">Metropolis Marathon</div>
                        <div class="musicevent-event-details">
                            <div>📅 Tuesday, June 07 | 06:00 AM</div>
                            <div>📍 Atlanta</div>
                        </div>
                        <div class="musicevent-event-price">From $10</div>
                    </div>
                </div>

                <div class="musicevent-event-card">
                    <div class="musicevent-event-badge">Buy 2 get 1 free</div>
                    <img src="<?= ROOT ?>/assets/images/ticket/musicevent2.jpeg" alt="Metropolis Marathon" class="musicevent-event-image">
                    <div class="musicevent-event-info">
                        <div class="musicevent-event-title">Metropolis Marathon</div>
                        <div class="musicevent-event-details">
                            <div>📅 Tuesday, June 07 | 06:00 AM</div>
                            <div>📍 Atlanta</div>
                        </div>
                        <div class="musicevent-event-price">From $10</div>
                    </div>
                </div>
            </div>

            <a href="#" class="view-more">View more</a>

        </div>

    </main>

    <!-- Include Footer -->
    <div class="footer">

    </div>

</body>

</html>