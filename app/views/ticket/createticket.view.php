
<?php include ('../app/views/components/header.php'); ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Retrieve event data from session
$event_name = $_SESSION['event_data']['event_name'] ?? 'Event Title';
$description = $_SESSION['event_data']['description'] ?? 'No description provided';
$audience = $_SESSION['event_data']['audience'] ?? 'N/A';
$city = $_SESSION['event_data']['city'] ?? 'N/A';
$province = $_SESSION['event_data']['province'] ?? 'N/A';
$eventDate = $_SESSION['event_data']['eventDate'] ?? 'N/A';
$start_time = $_SESSION['event_data']['start_time'] ?? 'N/A';
$end_time = $_SESSION['event_data']['end_time'] ?? 'N/A';
$pricing = $_SESSION['event_data']['pricing'] ?? 'N/A';
$type = $_SESSION['event_data']['type'] ?? 'N/A';


// Track last visit time
if (isset($_SESSION['last_visit'])) {
    $last_visit = $_SESSION['last_visit'];
} else {
    $last_visit = "This is my first visit";
}
$_SESSION['last_visit'] = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/createticket.css">
</head>
<body>


    <div class="container">
        <!--create main content -->
        <div class="main-content">
            <form id="createticket" method="POST">
                <div class="ticket-container">
                    <h3>Create Tickets for Your Event</h3>
                    <div class = "form-group">
                        <label for="sale-strt-date">Sale Start Date</label>
                        <input type="date" id="sale-strt-date" name="sale_strt_date">
                    </div>

                    <div class = "form-group">
                        <label for="sale-strt-time">Sale Start Time</label>
                        <input type="time" id="sale-strt-time" name="sale_strt_time" >
                    </div>

                    <div class = "form-group">
                        <label for="sale-end-date">Sale End Date</label>
                        <input type="date" id="sale-end-date" name="sale_end_date">
                    </div>

                    <div class = "form-group">
                        <label for="sale-end-time">Sale End Time</label>
                        <input type="time" id="sale-end-time" name="sale_end_time">
                    </div>

                    <div class="form-group">
                        <label for="ticket_type">Ticket Type</label>
                        <input type="TEXT" id="type" name="ticket_type">
                    </div>

                    <div class="form-group">
                        <label>Opportunities</label>
                        <div id="opportunity-container">
                            <!-- Default input field -->
                            <input type="text" name="restrictions[]" class="opportunity-input" >
                        </div>
                        <button type="button" id="add-opportunity" class="review-button">Add More Opportunities</button>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price">
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="review-button" name="add_another">Add Another Type of Ticket</button>
                        <button type="submit" class="review-button" name="submit">Review</button>
                    </div>
                </div>
            </form>   
        </div>
    </div>

    <?php if(!empty($data)): ?>
        <?php 
            $message = $data['error'];
            include("../app/views/components/r-message.php")
        ?>
    <?php endif ?>

    <script src="<?= ROOT ?>/assets/js/ticker/ticket.js"></script>
    <script src="<?=ROOT?>/assets/js/signin-up.js"></script>
    <script src="<?=ROOT?>/assets/js/message.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons.js"></script>
</body>
</html>
