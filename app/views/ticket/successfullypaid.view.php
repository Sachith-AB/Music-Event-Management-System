<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase Success</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/ticket/ticketstyle.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/ticket/popupmodal-style.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">


    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</head>
<?php $email = htmlspecialchars($_GET['email']) ; ?>
    <main>
        <?php if (!empty($purchaseDetails) && !empty($eventAndTicketDetails)): ?>
            <!-- get the duration -->
            <?php
            $eventStartTime = strtotime($eventAndTicketDetails[0]->event_date);
            $eventEndTime = strtotime($eventAndTicketDetails[0]->event_endtime);
            $durationInSeconds = $eventEndTime - $eventStartTime;
            $durationInHours = $durationInSeconds / 3600;
            $durationInHours = round($durationInHours);
            ?>
            <div class="event-details-container-success">
                <div class="back-button">
                    <div>
                        <!-- Include Back Button Component -->
                        <?php include('../app/views/components/backbutton.view.php'); ?>
                    </div>
                    
                    <div class="success-message">
                        <div class="success-icon">
                            &#10004;
                        </div>
                        <div class="success-text">
                            Successful payment!
                        </div>
                    </div>
                </div>
                
                <h1 class="event-title"><span><?= htmlspecialchars($eventAndTicketDetails[0]->event_name) ?></span>  <?= htmlspecialchars($eventAndTicketDetails[0]->event_description) ?></h1>
                <div class="event-info">
                    <div class="event-item">
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <h3>Date and Time</h3>
                            <p><?= htmlspecialchars(date("l, F d", strtotime($eventAndTicketDetails[0]->event_date))) ?><br /><?= htmlspecialchars(date("h:i A", strtotime($eventAndTicketDetails[0]->event_date))) ?></p>
                        </div>
                    </div>

                    <div class="event-item">
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h3>Duration</h3>
                            <p><?= $durationInHours ?> Hours</p>
                        </div>
                    </div>
                    <div class="event-item">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3>Place</h3>
                            <p class="two-line-ellipsis"><?= htmlspecialchars($eventAndTicketDetails[0]->address) ?></p>
                        </div>
                    </div>
                    <div class="event-item">
                        <div class="icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div>
                            <h3>Ticket</h3>
                            <p><?= htmlspecialchars($purchaseDetails[0]->ticket_quantity) ?></p>
                        </div>
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
                        <p><?= htmlspecialchars(date("l, F d", strtotime($purchaseDetails[0]->buy_time))) ?></p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Total</label>
                        <p>LKR <?= htmlspecialchars($purchaseDetails[0]->ticket_quantity * $eventAndTicketDetails[0]->ticket_price) ?></p>
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
                    <label for="first-name">First Name</label>
                        <p><?= htmlspecialchars($purchaseDetails[0]->buyer_Fname) ?></p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Last Name</label>
                        <p?><?= htmlspecialchars($purchaseDetails[0]->buyer_Lname) ?></p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Email</label>
                        <p><?= htmlspecialchars($purchaseDetails[0]->buyer_email) ?></p>
                    </div>
                    <div class="input-field">
                        <label for="last-name">Phone number</label>
                        <p><?= htmlspecialchars($purchaseDetails[0]->buyer_phoneNo) ?></p>
                    </div>
                </div>
            </div>

                <!--ticket section-->

                <div class="event-details-container">
                    <div class="contact-header">
                        <h3>Ticket (<?= htmlspecialchars($purchaseDetails[0]->ticket_quantity) ?>) total: <span>LKR <?= htmlspecialchars($purchaseDetails[0]->ticket_quantity * $eventAndTicketDetails[0]->ticket_price) ?></span></h3>
                        <a href="#" class="login-link" onclick="openViewTicketModal()">View Ticket</a>
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


                <div class="event-details-container">
                    <?php
                    for ($i = 0; $i < $purchaseDetails[0]->ticket_quantity; $i++) :
                        $qrData = [
                            'ticket_number' => $eventAndTicketDetails[0]->ticket_quantity+($i + 1),
                            'event_name' => $eventAndTicketDetails[0]->event_name,
                            'buyer_email' => $purchaseDetails[0]->buyer_email
                        ];
                        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode(json_encode($qrData));?>
                        <div class="ticket-details">
                            <div class="ticket-header">
                                <h3>Ticket <?= $i + 1 ?></h3>
                            </div>
                            <div class="input-group">
                                <div class="input-field">
                                    <label>First Name</label>
                                    <p><?= htmlspecialchars($purchaseDetails[0]->buyer_Fname) ?></p>
                                </div>
                                <div class="input-field">
                                    <label>Last Name</label>
                                    <p><?= htmlspecialchars($purchaseDetails[0]->buyer_Lname) ?></p>
                                </div>
                                <div class="input-field">
                                    <label>Email</label>
                                    <p><?= htmlspecialchars($purchaseDetails[0]->buyer_email) ?></p>
                                </div>
                                <div class="input-field">
                                    <label>Phone number</label>
                                    <p><?= htmlspecialchars($purchaseDetails[0]->buyer_phoneNo) ?></p>
                                </div>
                                <div class="input-field">
                                    <div class="qr-code">
                                        <p><strong>Code</strong></p>
                                        <!-- <a href="#"><?= htmlspecialchars($uniqueCode) ?></a> -->
                                        <div id="imgBox">
                                            <img class="qr-code-img" src="<?= $qrCodeUrl ?>" alt="QR Code for Ticket <?= $i + 1 ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                        <!--modal foe ticket view button-->
                        <div id="ticketModal" class="ticketdownloadmodal">
                            <div class="model-content-scroll">
                                <div class="modal-content">
                                    <span class="close" onclick="closeViewTicketModal()">&times;</span>

                                    <?php
                                            for ($i = 0; $i < $purchaseDetails[0]->ticket_quantity; $i++) :
                                    $qrData = [
                                        'ticket_number' => $eventAndTicketDetails[0]->ticket_quantity+($i + 1),
                                        'event_name' => $eventAndTicketDetails[0]->event_name,
                                        'buyer_email' => $purchaseDetails[0]->buyer_email
                                    ];
                                    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode(json_encode($qrData));?>


                                    <div class="digiticket">
                                        <div class="digiticket-left">
                                            <div class="digiticket-qr-code">
                                                <img src="<?= $qrCodeUrl ?>" alt="QR Code">
                                            </div>
                                            <div class="digiticket-qr-code-part">
                                                <p><strong>Code</strong></p>
                                                <button class="digiticket-qr-code-part-button" onclick="downloadTicket(this)">Download</button>
                                            </div>
                                        </div>
                                        <div class="digiticket-right">
                                            <div class="digiticket-content">
                                                <h1 class="digievent-title"><?= htmlspecialchars($eventAndTicketDetails[0]->event_name) ?></h1>
                                                <p class="digievent-subtitle"><?= htmlspecialchars($eventAndTicketDetails[0]->event_description) ?></p>
                                                <p class="digievent-date"><?= htmlspecialchars(date("l, F d, Y h:i A", strtotime($eventAndTicketDetails[0]->event_date))) ?> / at <?= htmlspecialchars($eventAndTicketDetails[0]->address) ?></p>
                                                <div class="digiticket-price">
                                                    <p class="price-label">Public Ticket</p>
                                                    <p class="price-value"><?= htmlspecialchars($eventAndTicketDetails[0]->ticket_price) ?> LKR</p>
                                                    <p class="price-desc">One ticket for one person.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            
                        </div>


                        <script>
                            // function downloadTicket(button) {
                            //     const ticketElement = button.closest('.digiticket');

                            //     html2canvas(ticketElement).then(canvas => {
                            //         const link = document.createElement('a');
                            //         link.download = 'ticket.png';
                            //         link.href = canvas.toDataURL();
                            //         link.click();
                            //     });
                            // }
                            
                            function downloadTicket(button) {
                                const ticketElement = button.closest('.digiticket');

                                // Wait for all images inside the ticket to load
                                const images = ticketElement.querySelectorAll("img");
                                //ensure that all images are loaded
                                const imagePromises = Array.from(images).map(img => {
                                    if (img.complete) return Promise.resolve();
                                    return new Promise(resolve => {
                                        img.onload = resolve;
                                        img.onerror = resolve; // resolve even if it fails
                                    });
                                });

                                Promise.all(imagePromises).then(() => {
                                    html2canvas(ticketElement, {
                                        useCORS: true // allow QR image from external source
                                    }).then(canvas => {
                                        const link = document.createElement('a');
                                        link.download = 'ticket.png';
                                        link.href = canvas.toDataURL('image/png');
                                        link.click();
                                    });
                                });
                            }
                            

                        </script>

                    

                    <form id="purchaseForm" method="POST">
                        <input type="hidden" name="first-name" value= "<?php echo $purchaseDetails[0]->buyer_Fname ?>" />
                        <input type="hidden" name="last-name" value= "<?php echo $purchaseDetails[0]->buyer_Lname ?>" />
                        <input type="hidden" name="ticketCount" value= "<?php echo $purchaseDetails[0]->ticket_quantity?>" />
                        <input type="hidden" name="eventname" value= "<?php echo $eventAndTicketDetails[0]->event_name ?>" />
                        <input type="hidden" name="eventdate" value= "<?php echo $eventAndTicketDetails[0]->event_date?>" />
                        <input type="hidden" name="address" value= "<?php echo $eventAndTicketDetails[0]->event_city ?? ""?>" />
                        <input type="hidden" name ="email" value = "<?php echo $email?>"/>

                
                    <div class="button-group">
                        <button type="button" class="add-ticket-btn" onclick="<?= $_SESSION['USER']->role === 'collaborator' ? 'goToColloboratorProfile()' : 'goToMyTickets()' ?>">Go to profile</button>

                        <button type="submit" class="pay-now-btn" name="submit">Send Email for Ticket</button>
                    </div>
                    </form>
                </div>
                <script>
                    
                    function goToMyTickets() {
                        
                            window.location.href = "profile";
                        
                    }
                    function goToColloboratorProfile(){
                        window.location.href = "colloborator-mytickets";
                    }
                </script>

            </div>
            <div class="event-details-container">
            <!--other event section-->
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
            
                <!-- <a href="#" class="view-more">View more</a> -->
            <?php else: ?>
                <p>No events created yet.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>No purchase created.</p>
        <?php endif; ?>
        </div>
    </main>



    



</html>
<?php include ('../app/views/components/footer.php'); ?>