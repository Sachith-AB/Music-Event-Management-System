<?php require_once '../app/helpers/load_notifications.php'; ?>
<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Buy Ticket</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticketHolder/deletenuyticket.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/backbutton.css">
</head>
<?php $ticket_id = htmlspecialchars($_GET['ticket_id']?? '');
?>
<body>
    <div class="container">
        <div class="back-button">
            <!-- Include Back Button Component -->
            <?php include('../app/views/components/backbutton.view.php'); ?>
            <h1>Purchased Tickets</h1>
        </div>
        
        <div class="card-container">
            <?php if(!empty($data)): ?>
                <?php foreach($data as $ticket): ?>
                    <div class="ticket-card">
                        <h3><?= htmlspecialchars($ticket->ticket_type) ?></h3>
                        <p><strong>Price:</strong> Rs. <?= number_format($ticket->price, 2) ?></p>
                        <p><strong>Quantity:</strong> <?= $ticket->ticket_quantity ?></p>
                        <p><strong>Buyer:</strong> <?= htmlspecialchars($ticket->buyer_Fname . ' ' . $ticket->buyer_Lname) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($ticket->buyer_email) ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($ticket->buyer_phoneNo) ?></p>
                        <p><strong>Buy Time:</strong> <?= htmlspecialchars($ticket->buy_time) ?></p>
                        <p><strong>Status:</strong> 
                            <span class="badge <?= $ticket->payment_status == 'complete' ? 'success' : 'pending' ?>">
                                <?= ucfirst($ticket->payment_status) ?>
                            </span>
                        </p>
                        <form method="POST">
                            <input type="hidden" name="purchase_id" value="<?= $ticket->id ?>">
                            <button type="submit" name="delete_purchase" class="delete-btn">🗑 Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No tickets available</p>
            <?php endif ;?>
        </div>
    </div>
</body>
</html>