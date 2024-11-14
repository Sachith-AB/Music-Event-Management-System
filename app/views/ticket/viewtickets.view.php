<?php include ('../app/views/components/Header.php'); ?>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
                    
                    <?php if (htmlspecialchars($ticket->ticket_type)=='SILVER'): ?>
                        <div class="ticket-card">
                            <div class="icon-container">
                                <div class="silver-card">
                                    <i class="fas fa-medal"></i>
                                </div>
                            </div>
                            
                            <div class="ticket-details">
                                <div class="ticket-info">
                                    <span class="ticket-type"><?= htmlspecialchars($ticket->ticket_type) ?></span>
                                    <span class="ticket-price">Price: LKR<?= htmlspecialchars($ticket->price) ?></span>
                                    <span class="ticket-quantity">Quantity: <?= htmlspecialchars($ticket->quantity) ?></span>
                                </div>
                                <div class="ticket-actions">
                                    <form action="update-ticket" method="get">
                                        <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket->id) ?>">
                                        <button class="btn btn-update" type="submit">Update</button>
                                    </form>
                                    <form action="delete-ticket" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                        <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket->id) ?>">
                                        <button class="btn btn-delete" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    

                        <?php elseif (htmlspecialchars($ticket->ticket_type) == 'GOLD') : ?>
                            <div class="ticket-card">
                                <div class="icon-container">
                                    <div class="gold-card">
                                        <i class="fas fa-crown"></i>
                                    </div>
                                </div>
                                <div class="ticket-details">
                                    <div class="ticket-info">
                                        <span class="ticket-type"><?= htmlspecialchars($ticket->ticket_type) ?></span>
                                        <span class="ticket-price">Price: LKR<?= htmlspecialchars($ticket->price) ?></span>
                                        <span class="ticket-quantity">Quantity: <?= htmlspecialchars($ticket->quantity) ?></span>
                                    </div>
                                
                                    <div class="ticket-actions">
                                        <form action="update-ticket" method="get">
                                            <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket->id) ?>">
                                            <button class="btn btn-update" type="submit">Update</button>
                                        </form>
                                        <form action="delete-ticket" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                            <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket->id) ?>">
                                            <button class="btn btn-delete" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                            <?php elseif (htmlspecialchars($ticket->ticket_type) == 'PLATINUM') : ?>
                            <div class="ticket-card">
                                <div class="icon-container">
                                    <div class="platinum-card">
                                        <i class="fas fa-gem"></i>
                                    </div>
                                </div>
                                <div class="ticket-details">
                                    <div class="ticket-info">
                                        <span class="ticket-type"><?= htmlspecialchars($ticket->ticket_type) ?></span>
                                        <span class="ticket-price">Price: LKR<?= htmlspecialchars($ticket->price) ?></span>
                                        <span class="ticket-quantity">Quantity: <?= htmlspecialchars($ticket->quantity) ?></span>
                                    </div>
                                
                                    <div class="ticket-actions">
                                        <form action="update-ticket" method="get">
                                            <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket->id) ?>">
                                            <button class="btn btn-update" type="submit">Update</button>
                                        </form>
                                        <form action="delete-ticket" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                            <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket->id) ?>">
                                            <button class="btn btn-delete" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                <?php endforeach; ?>
            <?php else: ?>
                <p>No tickets available.</p>
            <?php endif; ?>

            <p class="last-visit">Last Visit: <?= $last_visit ?></p>
        </div>
    </div>

    <button onclick ="goToRequest()"> Next </button>

    <?php $id = htmlspecialchars($_GET['event_id']); ?>

    <script>
        function goToRequest() {
            window.location.href = "request-singers?id=<?php echo $id?>";
        }
    </script>

</body>
</html>
