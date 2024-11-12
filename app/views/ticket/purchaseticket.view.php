

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/ticketstyle.css">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <!-- Include Header -->
    
    <!-- Main Content -->
    <main>
        <?php if (!empty($ticketdetails)): ?>
            <div class="event-details-container">
                <h1 class="event-title"><span><?= htmlspecialchars($ticketdetails[0]->event_name) ?></span>: <?= htmlspecialchars($ticketdetails[0]->event_description) ?></h1>
                <div class="event-info">
                    <div class="event-item">
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <h3>Date and Time</h3>
                            <p><?= htmlspecialchars(date("l, F d", strtotime($ticketdetails[0]->event_date))) ?><br /><?= htmlspecialchars(date("h:i A", strtotime($ticketdetails[0]->event_date))) ?></p>
                        </div>
                    </div>

                    <div class="event-item">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3>Place</h3>
                            <p><?= htmlspecialchars($ticketdetails[0]->event_city) ?><br><?= htmlspecialchars($ticketdetails[0]->event_province) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-line"></div>
            <form method="POST">
            <!-- Contact section -->
                <div class="event-details-container">
                    <div class="contact-header">
                        <h2>Contact information</h2>
                    </div>

                    <div class="input-group">
                        <div class="input-field">
                            <label for="first-name">First name</label>
                            <input type="text" id="first-name" name="first-name" placeholder="" required>
                        </div>
                        <div class="input-field">
                            <label for="last-name">Last name</label>
                            <input type="text" id="last-name" name="last-name" placeholder="" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="" required>
                        </div>
                        <div class="input-field">
                            <label for="phone">Phone number</label>
                            <input type="tel" id="phone" name="phone" placeholder="" required>
                        </div>
                    </div>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="updates" checked> Keep me updated on this event</label>
                        <label><input type="checkbox" name="agree" checked> I agree with the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a></label>
                    </div>
                </div>

                <!-- Ticket section -->
                <div class="event-details-container">
                    <h2>Ticket</h2>
                    <div class="ticket-selection">
                        <div class="available">
                            <div class="price">
                                <p>LKR <?= htmlspecialchars($ticketdetails[0]->ticket_price) ?> / <?= htmlspecialchars($ticketdetails[0]->ticket_type) ?> Ticket</p>
                            </div>
                            <div class="ticket-header">
                                <h3><?= htmlspecialchars($ticketdetails[0]->ticket_quantity) ?> Tickets Available</h3>
                            </div>
                        </div>
                        <div class="available">
                            <p class="getticket">Get Tickets</p>
                            <div class="ticket-quantity">
                                <button type="button" class="decrease-btn" onclick="decreaseQuantity()">-</button>
                                <input type="number" id="ticketCount" name="ticketCount" value="1" min="1" readonly>
                                <button type="button" class="increase-btn" onclick="increaseQuantity()">+</button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="next-btn" name="submit">Next</button>
                </div>
            </form>

        <?php else: ?>
            <p>No events created yet.</p>
        <?php endif; ?>

        <!--summary section -->
        <div id="summaryModal">
            <div class="summary-container">
                <span class="close" onclick="closeModal()">&times;</span>
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
                    <img src="<?=ROOT?>/assets/images/ticket/mastercard-icon.png" alt="Mastercard">
                    <span>Mastercard **** 5987</span>
                </div>
                <button class="pay-now-btn" onclick="goToMyTickets()">Pay now</button>

                <!--add script to go go successfullypaid page-->
                <script>
                    function goToMyTickets() {
                        const modal = document.getElementById('summaryModal');
                        if (modal) {
                            modal.remove(); // Remove the modal from the DOM
                        }
                        window.location.href = "successfullypaid";
                    }
                </script>
            </div>
        </div>
        <script src="<?= ROOT ?>/assets/js/ticker/purchesticket.js"></script>

        <!--other event section-->
        <!-- <div class="event-details-container"> -->
            <h2>Other events you may like</h2>
            <?php if (!empty($recentevents)): ?>
                <div class="musicevent-events-container">
                    <?php foreach ($recentevents as $event): ?>
                        <div class="musicevent-event-card">
                            <!-- <div class="musicevent-event-badge">20% OFF</div> -->
                            <img src=<?= htmlspecialchars($event->cover_images) ?> alt="Musical Fusion Festival" class="musicevent-event-image">
                            <div class="musicevent-event-info">
                                <div class="musicevent-event-title"><?= htmlspecialchars($event->event_name) ?></div>
                                <div class="musicevent-event-details">
                                    <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event->start_time))) ?></div>
                                    <div>📍 <?= htmlspecialchars($event->city) ?>, <?= htmlspecialchars($event->province) ?></div>
                                </div>
                                <!-- <div class="musicevent-event-price">From $80</div> -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            
                <a href="#" class="view-more">View more</a>
            <?php else: ?>
                <p>No events created yet.</p>
            <?php endif; ?>

        <!-- </div> -->

            
    </main>

    <!-- Include Footer -->
    <div class="footer">
        
    </div>

</body>
</html>
