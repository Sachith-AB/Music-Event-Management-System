<?php include ('../app/views/components/header.php'); ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['last_visit'])){
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
<?php include ('../app/views/components/loading.php'); ?>

    <div class="container">

            <!--create slide bar -->
        <div class="sidebar">
            
        </div>


        <!--create main content -->
        <div class="main-content">
        <?php if (!empty($ticket) && isset($ticket['ticket'][0])): ?>
                <form id="createticket" method="POST">
                    <div class="ticket-container">
                        <h3>Ticket</h3>
                        <!-- Hidden field to identify the ticket -->
                        <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket['ticket'][0]->id) ?>">

                        <input type="hidden" name="event_id" value="<?= htmlspecialchars($ticket['ticket'][0]->event_id) ?>">

                        <!-- Quantity field with prefilled value -->
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($ticket['ticket'][0]->quantity) ?>">
                        </div>

                        <!-- Price field with prefilled value -->
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" name="price" value="<?= htmlspecialchars($ticket['ticket'][0]->price) ?>">
                        </div>
                    </div>

                    <!-- Sale Date Section -->
                    <div class="sale-date-container">
                        <h3>Sale Date</h3>

                        <!-- Start Date field with prefilled value -->
                        <div class="form-group">
                            <label for="sale-strt-date">Start Date</label>
                            <input type="date" id="sale-strt-date" name="sale_strt_date" value="<?= htmlspecialchars($ticket['ticket'][0]->sale_strt_date) ?>">
                        </div>

                        <!-- Start Time field with prefilled value -->
                        <div class="form-group">
                            <label for="sale-strt-time">Start Time</label>
                            <input type="time" id="sale-strt-time" name="sale_strt_time" value="<?= htmlspecialchars($ticket['ticket'][0]->sale_strt_time) ?>">
                        </div>

                        <!-- End Date field with prefilled value -->
                        <div class="form-group">
                            <label for="sale-end-date">End Date</label>
                            <input type="date" id="sale-end-date" name="sale_end_date" value="<?= htmlspecialchars($ticket['ticket'][0]->sale_end_date) ?>">
                        </div>

                        <!-- End Time field with prefilled value -->
                        <div class="form-group">
                            <label for="sale-end-time">End Time</label>
                            <input type="time" id="sale-end-time" name="sale_end_time" value="<?= htmlspecialchars($ticket['ticket'][0]->sale_end_time) ?>">
                        </div>

                        <div class="button-container">
                            <div class="opportunity-container">
                                <h3>Restrictions</h3>
                                <?php if (!empty($restrictions)): ?>
                                    <div id="opportunity-container">
                                        <?php foreach($restrictions as $restriction): ?>
                                            <input type="text" name="restrictions[]" class="opportunity-input" value="<?= htmlspecialchars($restriction) ?>" >
                                        <?php endforeach; ?>
                                    </div>
                                    
                                <?php else: ?>
                                    <p>No restrictions defined. Add new restrictions below:</p>
                                <?php endif; ?>
                                <button type="button" id="add-opportunity" class="review-button">Add More Opportunities</button>
                            </div>
                            <button type="submit" class="review-button" name="submit">Review</button>
                        </div>
                    </div>

                </form>
            <?php else: ?>
                <p>No ticket data available to display.</p>
            <?php endif; ?>
        </div>
        <script src="<?= ROOT ?>/assets/js/ticker/ticket.js"></script>
    </div>

    
</body>
</html>
