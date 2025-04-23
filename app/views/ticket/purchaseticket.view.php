<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/ticketstyle.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

    <!-- Include Header -->
    <?php include ('../app/views/components/loading.php'); ?>
    
    <!-- Main Content -->
    <main>
        <?php if (!empty($ticketdetails)): ?>
            <div class="event-details-container">
                
                <h1 class="event-title">
                    <div class="back-button-purchase">
                        <!-- Include Back Button Component -->
                        <?php include('../app/views/components/backbutton.view.php'); ?>
                    </div>
                    
                    <span><?= htmlspecialchars($ticketdetails[0]->event_name) ?></span>: <?= htmlspecialchars($ticketdetails[0]->event_description) ?>
                </h1>
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
                            <p><?= htmlspecialchars($ticketdetails[0]->address) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-line"></div>
            <form id="purchaseForm" method="POST">
                <!-- Contact section -->
                <div class="event-details-container">
                    <div class="contact-header">
                        <h2>Contact information</h2>
                    </div>

                    <div class="input-group">
                        <div class="input-field">
                            <label for="first-name">First name</label>
                            <input type="text" id="first-name" name="first-name" placeholder="">
                        </div>
                        <div class="input-field">
                            <label for="last-name">Last name</label>
                            <input type="text" id="last-name" name="last-name" placeholder="">
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="">
                        </div>
                        <div class="input-field">
                            <label for="phone">Phone number</label>
                            <input type="tel" id="phone" name="phone" placeholder="07********">
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
                                <input type="hidden" name="availableticketcount" id="availableticketcount" value="<?= htmlspecialchars($ticketdetails[0]->ticket_quantity) ?>">
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
                    <button type="button" class="next-btn" onclick="openModal()">Next</button>


                </div>
            

                <script>
                    const ticketDetails = <?= json_encode([
                        'quantity' => $ticketdetails[0]->ticket_quantity,
                        'price' => $ticketdetails[0]->ticket_price,
                        'type' => $ticketdetails[0]->ticket_type,
                        'discount' =>$ticketdetails[0]->discount,
                        // Add any other details as needed
                    ]) ?>;
                </script>


                <!--summary section -->
                <div id="summaryModal" style="display: none;"> <!-- Initially hidden -->
                    <div class="summary-container">
                        <span class="close" onclick="closeModal()">&times;</span>
                        
                        <!-- Ticket Summary -->
                        <div class="summary-row">
                            <p><span id="ticketCountDisplay"></span></p>
                            <p id="ticketTypeDisplay"></p>
                        </div>
                        <div class="summary-row">
                            <p>Subtotal</p>
                            <p id="subtotalDisplay"></p>
                        </div>
                        <div class="summary-row">
                            <p>Discount</p>
                            <p id="discountDisplay"></p>
                        </div>
                        <div class="summary-total">
                            <p>Total</p>
                            <p id="totalDisplay"></p>
                        </div>
                        <!-- Payment Method -->
                        <!-- <div class="payment-method">
                            <img src="<?=ROOT?>/assets/images/ticket/mastercard-icon.png" alt="Mastercard">
                            <span>Mastercard **** 5987</span>
                        </div> -->

                        <button type="submit" class="pay-now-btn" name="submit">Pay now</button>
                        

                        <script>
                            function confirmPurchase() {
                                document.getElementById("purchaseForm").submit(); // This submits the form
                            }
                        </script>
                    </div>
                </div>

                <script src="<?= ROOT ?>/assets/js/ticker/purchesticket.js"></script>
                <script>
                    function goToSuccessfullypaid() {
                        window.location.href = "successfullypaid?id";
                    }
                </script>
            </form>
            
        <?php else: ?>
            <p>No events created yet.</p>
        <?php endif; ?>
        <!--other event section-->
        <div class="event-details-container">
            <h2>Other events you may like</h2>
            <?php if (!empty($recentevents)): ?>
                <div class="musicevent-events-container">
                    <?php foreach ($recentevents as $event): ?>
                        <div class="musicevent-event-card">
                            <!-- <div class="musicevent-event-badge">20% OFF</div> -->
                            <?php
                            $coverImages = json_decode($event->cover_images, true);
                            $firstImage = $coverImages[0] ?? ''; // fallback if empty
                            ?>
                            <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="Musical Fusion Festival" class="musicevent-event-image">
                            <div class="musicevent-event-info">
                                <div class="musicevent-event-title"><?= htmlspecialchars($event->event_name) ?></div>
                                <div class="musicevent-event-details">
                                    <div>📅 <?= htmlspecialchars(date("l, F d | h:i A", strtotime($event->start_time))) ?></div>
                                   
                                    <div class="two-line-ellipsis">📍 <?= htmlspecialchars($event->address) ?></div>
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

        </div>

            
    </main>
    <?php if(!empty($data)): ?>
        <?php 
            $message = $data['error'];
            // show($message);
            include("../app/views/components/r-message.php")
            
        ?>
    <?php endif ?>

    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>
    <script src="<?=ROOT?>/assets/js/message.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script> 
    

</body>
</html>
<?php include ('../app/views/components/footer.php'); ?>