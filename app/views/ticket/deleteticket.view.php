<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ticket/deleteticket.css">
</head>
<?php $ticket_id = htmlspecialchars($_GET['ticket_id']?? '');
?>
<body>
<?php include ('../app/views/components/loading.php'); ?>
    <!-- Main Content -->
        <div class="main-content">
            <section>
                <div>
                    <h2 class = "event-title"><?php echo $data[0]->event_name ?></h2>
                </div>
            </section>
            <section>
                <p class = "event-info">Ticket Name: <?php echo $data[0]->ticket_type ?></p>
                <p class = "event-info">Ticket Price: <?php echo $data[0]->ticket_price ?></p>
                <p class = "event-info">Ticket Quantity: <?php echo $data[0]->ticket_quantity ?></p>
            </section>
            <section id="validation">
                <h2>Are you sure you want to delete this ticket type?</h2>
            </section>

            <div class ="action-buttons">
                <button onclick="goBack()" class="no-btn">No</button>
                <form method="POST">
                    <button type="submit" name="delete" class="yes-btn">Yes</button>
                </form>
                
            </div>
        </div>
    </div>


    <script>
       function goBack() {
            
            if (eventid) {
                window.location.href = `view-tickets?event_id=${eventid}`;
            } else {
                window.history.back();
            }
        }
    </script>
</body>
</html>
