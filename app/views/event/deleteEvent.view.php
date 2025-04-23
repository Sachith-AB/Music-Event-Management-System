<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Retrieve event data from session
$event_name = $_SESSION['event_data']['event_name'] ?? 'Event Title';
$description = $_SESSION['event_data']['description'] ?? 'No description provided';

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
    <title>Delete Event</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/eventDelete.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php include ('../app/views/components/loading.php'); ?>
    
    <div class="event-delete-container">
        <div class="event-delete-details">
            <div class="event-delete-header">
                <h2><?php echo htmlspecialchars($data['event_name']); ?></h2>
            </div>

            <div class="event-delete-info">
                <p><?php echo htmlspecialchars($data['description']); ?></p>
            </div>
        </div>

        <div class="event-delete-validation">
            <h2>Are you sure you want to delete this event?</h2>
            <p>This action cannot be undone.</p>
        </div>

        <div class="event-delete-buttons">
            <button onclick="goBack()">
                <i class="material-icons">arrow_back</i>
                No, Keep Event
            </button>

            <form method="POST" style="display: inline;">
                <input type="hidden" name="event_id" value="<?php echo $data['id']; ?>">
                <button type="submit" name="delete">
                    <i class="material-icons">delete_forever</i>
                    Yes, Delete Event
                </button>
            </form>
        </div>
    </div>

    <script>
        function goBack() {
            const eventName = "<?= htmlspecialchars($data['event_name']) ?>";
            if (eventName) {
                window.location.href = `event-review?event_name=${eventName}`;
            } else {
                window.history.back();
            }
        }
    </script>
</body>
</html>