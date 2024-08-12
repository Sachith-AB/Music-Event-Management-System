<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticketstyle.css">
</head>
<body>

    <!-- Include Header -->
    <div class="header">
        
    </div>
    <!-- Main Content -->
    <main>
        <div class="event-details-container">
            <div class="back-link">
                <a href="#">&#8592;     Purchase Ticket</a> <span class="time-left">Time left: 25:00</span>
            </div>
            <h1 class="event-title">Rock Revolt: A Fusion of Power and Passion</h1>
            <div class="event-info">
                <div class="event-item">
                    <div class="icon">
                        <img src="calendar-icon2.jpg" alt="Date Icon">
                    </div>
                    <div>
                        <h3>Date and Time</h3>
                        <p>Saturday, February 20<br>08:00 PM</p>
                    </div>
                </div>

                <div class="event-item">
                    <div class="icon">
                        <img src="location-icon.png" alt="Place Icon">
                    </div>
                    <div>
                        <h3>Place</h3>
                        <p>Central Park, New York, NY<br>United States</p>
                    </div>
                </div>
        </div>

        <div class="form-line"></div>


        <!--contact section-->
        <div class="event-details-container">
        <div class="contact-header">
            <h2>Contact information</h2>
            <a href="#" class="login-link">Log in</a>
        </div>
        <form>
            <div class="input-group">
                <div class="input-field">
                    <label for="first-name">First name</label>
                    <input type="text" id="first-name" placeholder="Amanda" required>
                </div>
                <div class="input-field">
                    <label for="last-name">Last name</label>
                    <input type="text" id="last-name" placeholder="Smith" required>
                </div>
            </div>

            <div class="input-group">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Amanda@email.com" required>
                </div>
                <div class="input-field">
                    <label for="phone">Phone number</label>
                    <input type="tel" id="phone" placeholder="(724) 651-7073" required>
                </div>
            </div>

            <div class="checkbox-group">
                <label><input type="checkbox" checked> Keep me updated on this event</label>
                <label><input type="checkbox" checked> I agree with the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a></label>
            </div>
        </form>
    </div>  
    
    <!--ticket section-->

    <div class="event-details-container">
        <h2>Ticket</h2>
        
        <!-- Ticket Selection -->
        <div class="ticket-selection">
            <div class="price">
                <p>$90 / Ticket</p>
            </div>
            <div class="quantity">
                <input type="radio" name="ticket-quantity" id="one-ticket">
                <label for="one-ticket">1</label>
                <input type="radio" name="ticket-quantity" id="two-tickets" checked>
                <label for="two-tickets">2</label>
            </div>
        </div>
        
        <!-- Ticket 1 -->
        <div class="ticket-details">
            <div class="ticket-header">
                <h3>Ticket 1</h3>
                <label><input type="checkbox"> Same contact information</label>
            </div>
            <div class="input-group">
                <div class="input-field">
                    <label for="first-name-1">First name</label>
                    <input type="text" id="first-name-1" placeholder="Amanda">
                </div>
                <div class="input-field">
                    <label for="last-name-1">Last name</label>
                    <input type="text" id="last-name-1" placeholder="Smith">
                </div>
            </div>
            <div class="input-group">
                <div class="input-field">
                    <label for="email-1">Email</label>
                    <input type="email" id="email-1" placeholder="Amanda@email.com">
                </div>
                <div class="input-field">
                    <label for="phone-1">Phone number</label>
                    <input type="tel" id="phone-1" placeholder="(724) 651-7073">
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
                    <label for="first-name-2">First name</label>
                    <input type="text" id="first-name-2" placeholder="Charles">
                </div>
                <div class="input-field">
                    <label for="last-name-2">Last name</label>
                    <input type="text" id="last-name-2" placeholder="Sanchez">
                </div>
            </div>
            <div class="input-group">
                <div class="input-field">
                    <label for="email-2">Email</label>
                    <input type="email" id="email-2" placeholder="Charles@email.com">
                </div>
                <div class="input-field">
                    <label for="phone-2">Phone number</label>
                    <input type="tel" id="phone-2" placeholder="(570) 775-9922">
                </div>
            </div>
        </div>

        <!-- Add Ticket Button -->
        <div class="button-group">
            <button type="button" class="add-ticket-btn">+ Add Ticket</button>
            <button type="button" class="next-btn" onclick="showSummary()">Next</button>
        </div>
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
            <img src="mastercard-icon.png" alt="Mastercard">
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

    <h2>Other events you may like</h2>

    <div class="musicevent-events-container">
        <div class="musicevent-event-card">
            <div class="musicevent-event-badge">20% OFF</div>
            <img src="musicevent1.jpg" alt="Musical Fusion Festival" class="musicevent-event-image">
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
            <img src="musicevent2.jpeg" alt="Metropolis Marathon" class="musicevent-event-image">
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


            
    </main>

    <!-- Include Footer -->
    <div class="footer">
        
    </div>

</body>
</html>
