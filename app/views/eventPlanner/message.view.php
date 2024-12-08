<?php include ('../app/views/components/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event planner dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventPlanner/message.css">
</head>
<body>
<?php include ('../app/views/components/loading.php');?>
    <!-- Include Header -->
    
    <div class="dash-container">
        <!-- Sidebar -->
        <?php include ('../app/views/components/eventPlanner/dashsidebar.php');  ?>
        <div class="dashboard">
            <?php if (!empty($eventMessages)) : ?>
                <?php foreach ($eventMessages as $event) : ?>
                    <div class="message-card">
                        <div class="card-header">
                            <h3><?= htmlspecialchars($event->event_name) ?></h3>
                            <p>Collaborator: <?= htmlspecialchars($event->collaborator_name) ?></p>
                        </div>
                        <div class="card-body">
                            <p>Last Message: <?= date('M d, Y H:i', strtotime($event->last_message_time)) ?></p>
                            <p>Total Messages: <?= $event->total_messages ?></p>
                        </div>
                        <button class="view-messages-btn" 
                                data-event-id="<?= $event->event_id ?>" 
                                data-collaborator-id="<?= $event->collaborator_id ?>">
                            View & Reply
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No messages available.</p>
            <?php endif; ?>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Attach click event listeners to all buttons
                document.querySelectorAll('.view-messages-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        const eventId = this.getAttribute('data-event-id');
                        const collaboratorId = this.getAttribute('data-collaborator-id');
                        
                        // Redirect to the collaborator-eventdetails page
                        window.location.href = `collaborator-eventdetails?event_id=${eventId}&sender_id=${collaboratorId}`;
                    });
                });
            });

        </script>

        
        
        
    </div>

    <script src="<?=ROOT?>/assets/js/eventPlanner.js"></script>
</body>
</html>
