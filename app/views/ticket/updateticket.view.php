<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicia - Ticket Purchase Success</title>
    
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/ticket/ticketstyle.css">

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Sen:wght@400..800&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Include Header -->
    <?php include ('../app/views/components/Header.php'); ?>

    <div class="event-details-container">
        Event view page
        <br>
        <button class="add-ticket-btn" onclick="openModal()">Update or delete Tickets</button>
    </div>
    <div id="UpdateTicket">
    <div class="ticket-management-container">
        <div class="eventname">
            <h2>Manage Tickets for Rockblast</h2>
        </div>

        <div class="ticket-type-list">
            <!-- Repeat this block for each ticket type -->
            <div class="ticket-type-item">
                <div class="ticket-info">
                    <h3>VIP Ticket</h3>
                    <p>Price: $150</p>
                    <p>Quantity: 50</p>
                    <p>Sold ticket quantity: 20</p>
                </div>
                <div class="ticket-actions">
                    <button class="update-btn" onclick="openUpdateModal('VIP Ticket')">Update</button>
                    <button class="delete-btn" onclick="confirmDelete('VIP Ticket')">Delete</button>
                </div>
            </div>
            <!-- Repeat block ends -->

            <div class="ticket-type-item">
                <div class="ticket-info">
                    <h3>Normal Ticket</h3>
                    <p>Price: $150</p>
                    <p>Quantity: 50</p>
                    <p>Sold ticket quantity: 20</p>
                </div>
                <div class="ticket-actions">
                    <button class="update-btn" onclick="openUpdateModal('VIP Ticket')">Update</button>
                    <button class="delete-btn" onclick="confirmDelete('VIP Ticket')">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Update Modal -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateModal()">&times;</span>
        <h3>Update Ticket</h3>
        <form>
            <label for="ticketType">Ticket Type</label>
            <input type="text" id="ticketType" name="ticketType" value="VIP Ticket" readonly>

            <label for="ticketPrice">Price</label>
            <input type="number" id="ticketPrice" name="ticketPrice" value="150">

            <label for="ticketQuantity">Quantity</label>
            <input type="number" id="ticketQuantity" name="ticketQuantity" value="50">

            <button type="submit" class="save-btn">Save Changes</button>
        </form>
    </div>
</div>

    </div>
    <script src="<?= ROOT ?>/assets/js/ticker/updateticket.js"></script>


    
</body>
</html>