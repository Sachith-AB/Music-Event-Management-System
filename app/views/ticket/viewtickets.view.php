<?php require_once '../app/helpers/load_notifications.php'; ?>
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
<?php $id = htmlspecialchars($_GET['event_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tickets</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/createticket.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/viewticket.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>
<body>
<?php include ('../app/views/components/loading.php'); ?>
    <div class="container">

        <!--create slide bar -->
        <div class="sidebar">
            <!-- Add sidebar content if needed -->
        </div>

        <!--create main content -->
        <div class="main-content">
            <h1>Ticket Information</h1>
            <!-- Display ticket cards -->
            <div class="ticket-container">
                <?php if (!empty($tickets)): ?>
                    <?php foreach ($tickets as $ticket): ?>
                        <div class="card">
                            <div class="img-box">
                            <img src="<?=ROOT?>/assets/images/ticket/ticket.png" alt="Ticket" />
                            </div>
                            <div class="content">
                                <div class="details">
                                    <br />
                                    <h2><?= htmlspecialchars($ticket->ticket_type) ?>
                                        <br />
                                        <!-- <span>LKR 1000</span> -->
                                    </h2>
                                    <div class="data">
                                        <h3>
                                            Price:
                                            <br />
                                            <span>LKR <?= htmlspecialchars($ticket->price) ?></span>
                                        </h3>
                                        <h3>
                                            Quantity: 
                                            <br />
                                            <span><?= htmlspecialchars($ticket->quantity) ?></span>
                                        </h3>
                                    </div>
                                    <div class="action-btn">
                                        <button class="btn-btn-update" type="submit" onclick="goUpdate(<?= htmlspecialchars($ticket->id) ?>)">Update</button>
                                        <button class="btn-btn-delete" type="submit" onclick="goDelete(<?= htmlspecialchars($ticket->id) ?>)">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No tickets available.</p>
                <?php endif; ?>
            </div>
            <button class="next-button" onclick ="goToBack()"> Back </button>
            <button class="next-button" onclick ="goToRequest()"> Next </button>

        </div>
    </div>

    <script>
        function goUpdate(ticket_id){
            window.location.href = "update-ticket?ticket_id="+ticket_id;
        }
        function goDelete(ticket_id){
            window.location.href = "delete-ticket?ticket_id="+ticket_id;
        }
        function goToRequest() {
            window.location.href = "request-singers?id=<?php echo $id?>";
        }

        function goToBack() {
            window.location.href = "create-ticket?event_id=<?php echo $id?>";
        }
    </script>

</body>
</html>
