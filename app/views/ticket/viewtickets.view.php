<!-- <?php include ('../app/views/components/CreateEventHeader.php'); ?> -->

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
    <title>View Tickets</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/create-event.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/viewticket.css">
</head>
<body>
    <div class="container">

        <!--create slide bar -->
        <div class="sidebar">
            <!-- Add sidebar content if needed -->
        </div>

        <!--create main content -->
        <div class="main-content">
            <h1>Ticket Information</h1>

            <!-- Display ticket cards -->
            <?php if (!empty($tickets)): ?>
                <?php foreach ($tickets as $ticket): ?>
                    <div class="ticket-card">
                        <div class="ticket-info">
                            <span class="ticket-type"><?= htmlspecialchars($ticket->ticket_type) ?></span>
                            <span class="ticket-price">Price: $<?= htmlspecialchars($ticket->price) ?></span>
                            <span class="ticket-quantity">Quantity: <?= htmlspecialchars($ticket->quantity) ?></span>
                        </div>

                        <div class="ticket-actions">
                            <form action="update-ticket.php" method="post">
                                <input type="hidden" name="ticket_id" value="<?= $ticket->_id ?>">
                                <button class="btn btn-update" type="submit">Update</button>
                            </form>
                            <form action="delete-ticket.php" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                <input type="hidden" name="ticket_id" value="<?= $ticket->_id ?>">
                                <button class="btn btn-delete" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No tickets available.</p>
            <?php endif; ?>

            <p class="last-visit">Last Visit: <?= $last_visit ?></p>
        </div>
    </div>
</body>
</html>
